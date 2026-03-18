<?php
namespace App\Models;

use Core\Database;
use PDO;

abstract class BaseModel
{
    protected string $table = '';
    protected string $primaryKey = 'id';
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Todos los registros
    public function all(string $orderBy = 'created_at', string $dir = 'DESC'): array
    {
        $dir  = strtoupper($dir) === 'ASC' ? 'ASC' : 'DESC'; // whitelist
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$dir}"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Buscar por PK
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    // Buscar con condición simple
    public function findBy(string $column, mixed $value): ?array
    {
        $column = preg_replace('/[^a-zA-Z0-9_]/', '', $column); // whitelist columna
        $stmt   = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE {$column} = :value LIMIT 1"
        );
        $stmt->execute([':value' => $value]);
        return $stmt->fetch() ?: null;
    }

    // Insertar registro
    public function create(array $data): int
    {
        $columns      = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})"
        );
        $stmt->execute($data);
        return (int) $this->db->lastInsertId();
    }

    // Actualizar por PK
    public function update(int $id, array $data): bool
    {
        $fields = implode(', ', array_map(
            fn($col) => "{$col} = :{$col}",
            array_keys($data)
        ));

        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET {$fields} WHERE {$this->primaryKey} = :__id"
        );
        $data[':__id'] = $id;
        return $stmt->execute($data);
    }

    // Eliminar por PK
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    // Contar registros
    public function count(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM {$this->table}");
        return (int) $stmt->fetchColumn();
    }
}