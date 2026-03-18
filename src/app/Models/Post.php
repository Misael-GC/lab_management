<?php
namespace App\Models;

class Post extends BaseModel
{
    protected string $table = 'posts';

    // Solo posts publicados para el blog público
    public function allPublished(): array
    {
        $stmt = $this->db->prepare(
            "SELECT id, title, slug, excerpt, created_at
             FROM {$this->table}
             WHERE status = 'published'
             ORDER BY created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Post publicado por slug
    public function findPublishedBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
             WHERE slug = :slug AND status = 'published'
             LIMIT 1"
        );
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch() ?: null;
    }
}