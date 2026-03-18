<?php
namespace App\Controllers;

use App\Models\Post;
use App\Controllers\BaseController;  // ✅ mismo namespace, no necesita use

class PostController extends BaseController   // ✅ mismo namespace
{
    private Post $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function index(array $params = []): void
    {
        $posts = $this->postModel->all();
        $this->render('posts/index', ['posts' => $posts]);
    }

    public function show(array $params = []): void
    {
        $slug = $params['slug'] ?? null;

        if (!$slug) {
            http_response_code(400);
            return;
        }

        $post = $this->postModel->findBy('slug', $slug);

        if (!$post) {
            http_response_code(404);
            return;
        }

        $this->render('posts/show', ['post' => $post]);
    }
}