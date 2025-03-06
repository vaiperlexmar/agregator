<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RSS Православие</title>
    <link rel="stylesheet" type="text/css" href="/style/index.css">
</head>

<body>
<header class="news__header">
    <span class="news__logo">
        <img class="news__logo_img" src="./assets/image/religion-cross-with-rss-logo.png">
        Religion Saint Society
    </span>
</header>
<div class="news__container">
    <?php
    foreach ($feed as $feedItem): ?>
        <a class="news__link" href=<?= "{$feedItem["link"]}" ?>>
            <div class="news__content">
                <img class="news__img" src=<?= "{$feedItem["imageUrl"]}" ?>>
                <h2 class="news__title"><?= "{$feedItem["title"]}" ?></h2>
                <p class="news__description"><?= "{$feedItem["description"]}" ?></p>
                <span class="news__date"><?= "{$feedItem["date"]}" ?></span>
            </div>
        </a>
    <?php
    endforeach; ?>
</div>
</body>
</html>