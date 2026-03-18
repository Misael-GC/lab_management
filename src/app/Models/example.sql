-- CREATE DATABASE IF NOT EXISTS blog_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS posts (
    id          INT UNSIGNED     AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255)     NOT NULL,
    slug        VARCHAR(255)     NOT NULL UNIQUE,
    excerpt     TEXT             NULL,
    content     LONGTEXT         NOT NULL,
    status      ENUM('draft','published','archived') NOT NULL DEFAULT 'draft',
    created_at  TIMESTAMP        DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP        DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_slug   (slug),
    INDEX idx_status (status)
);

INSERT INTO posts (title, slug, excerpt, content, status) VALUES
(
    'Bienvenido al Blog',
    'bienvenido-al-blog',
    'El primer post de nuestro blog construido con PHP y Docker.',
    'Este blog fue construido desde cero usando PHP puro con arquitectura MVC, Docker Compose con Nginx, PHP-FPM y MySQL. En los próximos posts explicaremos cada parte del stack.',
    'published'
),
(
    'Docker y PHP-FPM',
    'docker-y-php-fpm',
    'Cómo levantar un entorno PHP profesional con Docker Compose.',
    'Docker nos permite aislar servicios en contenedores reproducibles. Usamos PHP-FPM como gestor de procesos, Nginx como servidor web y MySQL como base de datos, todos conectados en una red interna.',
    'published'
),
(
    'Arquitectura MVC en PHP',
    'arquitectura-mvc-en-php',
    'Entendiendo el patrón Modelo Vista Controlador sin frameworks.',
    'MVC separa responsabilidades: el Modelo gestiona datos, la Vista presenta información y el Controlador coordina el flujo. Implementarlo sin Laravel nos enseña cómo funciona por dentro.',
    'published'
),
(
    'SOLID en PHP',
    'solid-en-php',
    'Los 5 principios SOLID aplicados a proyectos PHP reales.',
    'SOLID es un conjunto de principios de diseño orientado a objetos. Este post está en borrador y será publicado próximamente.',
    'draft'
),
(
    'Post Archivado de Prueba',
    'post-archivado-prueba',
    'Este post fue archivado.',
    'Contenido archivado para pruebas del sistema de estados.',
    'archived'
);