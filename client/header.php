<?php
$lang = $_COOKIE["lang"] ?? "fr";

$pageTitleFr = $pageTitleFr ?? "Page";
$pageTitleEn = $pageTitleEn ?? "Page";

$title = ($lang === "en") ? $pageTitleEn : $pageTitleFr;
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refuge Ti'Chats - <?= $title ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container">
        <a href="index.php" class="logo-link">
            <h1 class="logo" data-fr="Refuge Ti'Chats" data-en="Ti'Chats Shelter">Refuge Ti'Chats</h1>
        </a>
            <nav>
                <a href="index.php" data-fr="Accueil" data-en="Home">Accueil</a>
                <a href="animaux.php" data-fr="Nos Ti'Animaux" data-en="Our Animals">Nos Ti'Animaux</a>
            </nav>
            <div class="controls">
                <button id="langBtn" class="btn-control" title="Switch language">EN</button>
                <button id="themeBtn" class="btn-control" title="Toggle theme">🌙</button>
            </div>
        </div>
    </header>