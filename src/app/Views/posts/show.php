<div class="show-back">
    <a href="/blog">← Volver al blog</a>
</div>

<div class="show-header">
    <div class="hero-label">// <?= date('M d, Y', strtotime($post['created_at'])) ?></div>
    <h1 class="show-title"><?= $post['title'] ?></h1>
    <div class="show-meta">
        <span><?= ceil(str_word_count($post['content']) / 200) ?> min lectura</span>
        <span>//</span>
        <span>PHP · Docker · MVC</span>
    </div>
</div>

<div class="show-body">
    <?= nl2br($post['content']) ?>
</div>