<?php
namespace App\Models;

use PDO;
use DateTime;

class Note {
    private PDO $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    /** 🔑 Getter dla PDO (przydaje się w kontrolerze) */
    public function getDb(): PDO {
        return $this->db;
    }

    /** Zapis nowej notatki */
    public function create(array $data): string {
        $stmt = $this->db->prepare("
            INSERT INTO notes 
            (note_key, encrypted, iv, salt, password_protected, expire_at,
             max_views, notify_email, created_at, short_code, views) 
            VALUES (:key,:enc,:iv,:salt,:pass,:exp,:max_views,:email,NOW(),:short_code,0)
        ");
        $stmt->execute([
            ':key'        => $data['note_key'],
            ':enc'        => $data['encrypted'],
            ':iv'         => $data['iv'],
            ':salt'       => $data['salt'],
            ':pass'       => $data['password_protected'],
            ':exp'        => $data['expire_at'],
            ':max_views'  => $data['max_views'],
            ':email'      => $data['notify_email'],
            ':short_code' => $data['short_code'] ?? null
        ]);
        return $data['note_key'];
    }

    /** 🔎 Pobiera notatkę po kluczu (bez sprawdzania ważności) */
    public function findByKey(string $key): ?array {
        $stmt = $this->db->prepare("SELECT * FROM notes WHERE note_key = :k LIMIT 1");
        $stmt->execute([':k' => $key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** 🔎 Pobiera notatkę tylko jeśli jeszcze ważna */
    public function findValid(string $key): ?array {
        $stmt = $this->db->prepare("SELECT * FROM notes WHERE note_key = :k");
        $stmt->execute([':k' => $key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        if ($row['views'] >= $row['max_views'] && $row['max_views'] > 0) return null;
        if ($row['expire_at'] && new DateTime() > new DateTime($row['expire_at'])) return null;

        return $row;
    }

    /** 📈 Zwiększa licznik otwarć */
    public function incrementViews(int $id): void {
        $this->db->prepare(
            "UPDATE notes SET views = views + 1, last_opened_at = NOW() WHERE id = :id"
        )->execute([':id' => $id]);
    }

    /** 🗑 Usuwa notatkę */
    public function delete(int $id): void {
        $this->db->prepare("DELETE FROM notes WHERE id = :id")->execute([':id' => $id]);
    }

    /** ✏️ Aktualizuje short_code dla istniejącej notatki */
    public function updateShort(string $noteKey, string $shortCode): bool {
        $stmt = $this->db->prepare("UPDATE notes SET short_code = :s WHERE note_key = :k");
        return $stmt->execute([':s' => $shortCode, ':k' => $noteKey]);
    }
}
