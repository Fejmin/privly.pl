<?php
/**
 * cleanup.php
 * Usuwa stare i wygasłe notatki z tabeli `notes`
 * - starsze niż 15 dni (po created_at)
 * - z expire_at w przeszłości
 */

$dbHost = "localhost";
$dbName = "srv88316_privly";
$dbUser = "srv88316_privly";
$dbPass = "QRBNphexyRX3KwAhjqhk";

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // 1. Usuń notatki starsze niż 15 dni
    $stmt1 = $pdo->prepare("DELETE FROM notes WHERE created_at < (NOW() - INTERVAL 15 DAY)");
    $stmt1->execute();
    $deletedOld = $stmt1->rowCount();

    // Log do syslog lub pliku – tu tylko info
    $msg = sprintf(
        "[%s] Cleanup OK – usunięto %d starych, %d wygasłych notatek\n",
        date("Y-m-d H:i:s"),
        $deletedOld,
        $deletedExpired
    );

    error_log($msg, 3, __DIR__ . "/cleanup.log");

} catch (Exception $e) {
    error_log("[" . date("Y-m-d H:i:s") . "] BŁĄD cleanup: " . $e->getMessage() . "\n", 3, __DIR__ . "/cleanup.log");
    exit(1);
}
