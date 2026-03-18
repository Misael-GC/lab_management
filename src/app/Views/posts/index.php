<div class="hero">
    <div>
        <div class="hero-label">// publicaciones recientes</div>
        <h1>Ideas,<br>código &<br><em>aprendizaje</em></h1>
        <p class="hero-sub">Artículos sobre arquitectura de software, PHP, Docker y buenas prácticas.</p>
    </div>
    <div class="hero-count"><?= str_pad(count($posts), 2, '0', STR_PAD_LEFT) ?></div>
</div>

<div class="posts-section">
    <div class="section-header">
        <div class="section-line"></div>
        <span class="section-title">Todos los posts</span>
        <div class="section-line"></div>
    </div>

    <?php if (empty($posts)): ?>
        <p class="no-posts">No hay posts publicados aún.</p>
    <?php else: ?>
        <div class="posts-grid">
            <?php foreach ($posts as $i => $post): ?>
                <article class="post-card" style="animation-delay: <?= $i * 0.07 ?>s">
                    <div class="card-num">
                        <?= str_pad($i + 1, 3, '0', STR_PAD_LEFT) ?> — <?= date('Y.m.d', strtotime($post['created_at'])) ?>
                    </div>
                    <h2 class="card-title"><?= $post['title'] ?></h2>
                    <p class="card-excerpt"><?= $post['excerpt'] ?></p>
                    <div class="card-footer">
                        <span class="card-date"><?= date('M d, Y', strtotime($post['created_at'])) ?></span>
                        <a href="/blog/<?= $post['slug'] ?>" class="card-arrow">→</a>
                    </div>
                </article>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>