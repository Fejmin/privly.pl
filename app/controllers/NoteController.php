<?php
namespace App\Controllers;

use App\Models\Note;
use PDO;
use DateInterval;
use DateTime;

require_once __DIR__ . '/../plugins/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../plugins/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../plugins/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class NoteController
{
    private Note $note;
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;

        $db = new PDO(
            "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
            $config['db']['user'],
            $config['db']['pass'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $this->note = new Note($db);
    }

    /** WEB: zapis nowej notatki */
    public function store(): void
    {
        header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.tailwindcss.com https://unpkg.com/lucide@latest https://www.google.com/recaptcha/; style-src 'self' https://fonts.googleapis.com; img-src 'self'; frame-src https://www.google.com/recaptcha/;");

        $ciphertext = $_POST['ciphertext'] ?? '';
        $iv         = $_POST['iv'] ?? '';
        $salt       = $_POST['salt'] ?? null;
        $passwordProtected = (int)($_POST['password_protected'] ?? 0);

        // aktualizacja short_code
        if ($ciphertext === '' && $iv === '' && isset($_POST['note_key'], $_POST['short_code'])) {
            $this->updateShort();
            return;
        }

        if ($ciphertext === '' || $iv === '') {
            http_response_code(400);
            echo json_encode(['error' => 'Brak danych szyfrowania (ciphertext/iv).']);
            return;
        }

        $maxViews = (int)($_POST['max_views'] ?? 0);
        if ($maxViews < 0 || $maxViews > 10) $maxViews = 1;

        $email = filter_var($_POST['notify_email'] ?? '', FILTER_VALIDATE_EMAIL) ?: null;

        $expMap = [
            '1m'=>'PT1M','5m'=>'PT5M','30m'=>'PT30M','1h'=>'PT1H','4h'=>'PT4H',
            '12h'=>'PT12H','1d'=>'P1D','3d'=>'P3D','7d'=>'P7D','14d'=>'P14D'
        ];
        $chosen   = $_POST['expire'] ?? '';
        $interval = $expMap[$chosen] ?? null;

        $expireAt = null;
        if ($interval) {
            $expireAt = (new DateTime())->add(new DateInterval($interval));
        } elseif ($maxViews === 0) {
            $maxViews = 1;
        }
        $expireStr = $expireAt ? $expireAt->format('Y-m-d H:i:s') : null;

        $key = bin2hex(random_bytes(32));

        $this->note->create([
            'note_key'           => $key,
            'encrypted'          => $ciphertext,
            'iv'                 => $iv,
            'salt'               => $salt,
            'password_protected' => $passwordProtected,
            'expire_at'          => $expireStr,
            'max_views'          => $maxViews,
            'views'              => 0,
            'notify_email'       => $email,
            'short_code'         => $_POST['short_code'] ?? null
        ]);

        header('Content-Type: application/json');
        echo json_encode(['link' => "/note/$key"]);
    }

    /** WEB: aktualizacja short_code istniejącej notatki */
    public function updateShort(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $noteKey   = $_POST['note_key'] ?? '';
        $shortCode = $_POST['short_code'] ?? '';

        if ($noteKey === '' || $shortCode === '') {
            http_response_code(400);
            echo json_encode(['error' => 'Brak wymaganych danych']);
            return;
        }

        $ok = $this->note->updateShort($noteKey, $shortCode);

        echo json_encode(['success' => $ok]);
    }

    /** WEB: wyświetlenie */
    public function show(string $key): void
    {
        $row = $this->note->findByKey($key);
        $expired = !$row || $this->isExpired($row);

        if ($expired) {
            if ($row) {
                $this->deleteNoteAndShort($row);
            }
            $errorMessage = 'Notatka nie istnieje lub wygasła.';
            require __DIR__ . '/../views/view.php';
            return;
        }

        $noteMeta = [
            'has_password' => (bool)$row['password_protected'],
            'expire_at'    => $row['expire_at'],
            'max_views'    => $row['max_views'],
            'views'        => $row['views'],
            'notify_email' => $row['notify_email'] ?? null
        ];

        require __DIR__ . '/../views/view.php';
    }

    /** WEB: pobranie zaszyfrowanej treści (BEZ zliczania i usuwania limitów) */
    public function fetch(string $key): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $row = $this->note->findByKey($key);

        if (!$row) {
            echo json_encode(['error' => 'Notatka nie istnieje lub wygasła.']);
            return;
        }

        // tylko data ważności, bez licznika
        if (!empty($row['expire_at']) && new DateTime() >= new DateTime($row['expire_at'])) {
            $this->deleteNoteAndShort($row);
            echo json_encode(['error' => 'Notatka nie istnieje lub wygasła.']);
            return;
        }

        echo json_encode([
            'ciphertext'  => $row['encrypted'],
            'iv'          => $row['iv'],
            'salt'        => $row['salt'],
            'password_protected' => (int)$row['password_protected'],
            'expire_at'   => $row['expire_at'],
            'max_views'   => $row['max_views'],
            'views'       => (int)$row['views'],
            'notify_email'=> $row['notify_email'] ?? null,
            'sent_email'  => $row['notify_email'] ?? null
        ]);
    }

    /** WEB: potwierdzenie poprawnego odszyfrowania */
    public function confirmView(string $key): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $row = $this->note->findByKey($key);

        if (!$row) {
            echo json_encode(['error' => 'Notatka nie istnieje lub wygasła.']);
            return;
        }

        $newViews = (int)$row['views'] + 1;

        if ($row['max_views'] > 0) {
            $this->note->incrementViews((int)$row['id']);
        }

        // ⬇️ Nowa logika: zwracamy sukces dla ostatniego wyświetlenia,
        // a notatkę kasujemy dopiero po wysłaniu odpowiedzi
        $shouldDelete = false;
        if ($this->isExpired($row, $newViews)) {
            $shouldDelete = true;
        }

        echo json_encode([
            'success'   => true,
            'views'     => $newViews,
            'max_views' => $row['max_views'],
            'expire_at' => $row['expire_at']
        ]);

        if ($shouldDelete) {
            $this->deleteNoteAndShort($row);
        }
    }

    /** API: utworzenie notatki (E2EE) */
    public function apiStore(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Metoda niedozwolona']);
            return;
        }

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if (!is_array($data)) {
            http_response_code(400);
            echo json_encode(['error' => 'Nieprawidłowy JSON']);
            return;
        }

        $ciphertext = $data['ciphertext'] ?? '';
        $iv         = $data['iv'] ?? '';
        $salt       = $data['salt'] ?? null;
        $passwordProtected = (int)($data['password_protected'] ?? 0);

        if ($ciphertext === '' || $iv === '') {
            http_response_code(400);
            echo json_encode(['error' => 'Brak danych szyfrowania']);
            return;
        }

        $maxViews = (int)($data['max_views'] ?? 1);
        if ($maxViews < 1 || $maxViews > 10) $maxViews = 1;

        $email = filter_var($data['notify_email'] ?? '', FILTER_VALIDATE_EMAIL) ?: null;

        $expMap = [
            '1m'=>'PT1M','5m'=>'PT5M','30m'=>'PT30M','1h'=>'PT1H','4h'=>'PT4H',
            '12h'=>'PT12H','1d'=>'P1D','3d'=>'P3D','7d'=>'P7D','14d'=>'P14D'
        ];
        $expireOpt = $data['expire'] ?? '';
        $expireAt = isset($expMap[$expireOpt]) ? (new DateTime())->add(new DateInterval($expMap[$expireOpt])) : null;
        $expireStr = $expireAt ? $expireAt->format('Y-m-d H:i:s') : null;

        $key = bin2hex(random_bytes(32));

        $this->note->create([
            'note_key'           => $key,
            'encrypted'          => $ciphertext,
            'iv'                 => $iv,
            'salt'               => $salt,
            'password_protected' => $passwordProtected,
            'expire_at'          => $expireStr,
            'max_views'          => $maxViews,
            'views'              => 0,
            'notify_email'       => $email,
            'short_code'         => $data['short_code'] ?? null
        ]);

        echo json_encode([
            'success'   => true,
            'note_key'  => $key,
            'link'      => "/note/$key"
        ]);
    }

    private function isExpired(array $row, ?int $viewsOverride = null): bool
    {
        $now = new DateTime();

        if (!empty($row['expire_at']) && $now >= new DateTime($row['expire_at'])) {
            return true;
        }

        $views = $viewsOverride ?? (int)$row['views'];

        if ($row['max_views'] > 0 && $views >= $row['max_views']) {
            return true;
        }

        return false;
    }

    /** Usuwa notatkę i jej shortlink */
    private function deleteNoteAndShort(array $row): void
    {
        if (!empty($row['short_code']) && !empty($this->config['hoply']['admin_api_key'])) {
            $url = rtrim($this->config['hoply']['api_url'], '/') . "/delete?code=" . urlencode($row['short_code']);
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST  => "DELETE",
                CURLOPT_HTTPHEADER => [
                    "X-API-KEY: " . $this->config['hoply']['admin_api_key'],
                    "Content-Type: application/json"
                ]
            ]);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($response === false || $httpCode >= 400) {
                error_log("Hoply delete error [HTTP $httpCode]: " . $response);
            }
        }

        $this->note->delete((int)$row['id']);
    }
}
