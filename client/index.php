<?php
$pageTitleFr = "Accueil";
$pageTitleEn = "Home";
include("header.php");
require_once "../serveur/dbFunctions.php";

$recentAnimals = getRecentAnimals(3);
$lang = $_COOKIE['lang'] ?? 'fr';
?>

<main>

    <section class="hero-home">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1 data-fr="Offrez une nouvelle vie à un Ti'Animal ❤️"
                data-en="Give a new life to a Ti'Animal ❤️">
                Offrez une nouvelle vie à un Ti'Animal ❤️
            </h1>

            <p data-fr="Découvrez tous nos pensionnaires prêts à être adoptés."
               data-en="Discover all our residents ready to be adopted.">
               Découvrez tous nos pensionnaires prêts à être adoptés.
            </p>

            <a href="animaux.php" class="btn hero-btn"
               data-fr="Voir les animaux"
               data-en="See animals">
               Voir les animaux
            </a>
        </div>
    </section>

    <section class="filter-section">
        <div class="container">
            <form action="animaux.php" method="GET" class="filter-form">
                <input type="text" name="nom"
                    placeholder="<?= $lang === 'fr' ? 'Nom de l\'animal' : 'Animal Name' ?>" 
                    data-fr-placeholder="Nom de l'animal"
                    data-en-placeholder="Animal Name"
                >

                <select name="espece">
                    <option value="" data-fr="Espèce" data-en="Species">Espèce</option>
                    <option value="Chat" data-fr="Chat" data-en="Cat">Chat</option>
                    <option value="Chien" data-fr="Chien" data-en="Dog">Chien</option>
                    <option value="Autre" data-fr="Autre" data-en="Other">Autre</option>
                </select>

                <button type="submit" data-fr="Rechercher" data-en="Search">Rechercher</button>
            </form>
        </div>
    </section>

    <section class="featured">
        <div class="container">
            <h2 data-fr="Nouveaux pensionnaires 🐾"
                data-en="New arrivals 🐾">
                Nouveaux pensionnaires 🐾
            </h2>

            <div class="featured-grid">
                <?php if (!empty($recentAnimals)): ?>
                    <?php foreach ($recentAnimals as $a): ?>
                        <a href="animal.php?id=<?= $a['idanimal'] ?>" class="featured-card">
                            <img src="<?= htmlspecialchars($a['photourl']) ?>" alt="<?= htmlspecialchars($a['nomanimal']) ?>">
                            <h3><?= htmlspecialchars($a['nomanimal']) ?></h3>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p data-fr="Aucun animal récent pour le moment."
                       data-en="No new animals for now.">
                       Aucun animal récent pour le moment.
                    </p>
                <?php endif; ?>
            </div>

             <a href="animaux.php" class="btn hero-btn"
               data-fr="Voir les animaux"
               data-en="See animals">
               Voir les animaux
            </a>
        </div>
    </section>

    <section class="mission">
        <div class="container">
            <h2 data-fr="Notre mission" data-en="Our mission">Notre mission</h2>
            <p data-fr="Nous recueillons, soignons et protégeons les animaux dans le besoin. Votre adoption change leur vie."
               data-en="We rescue, care for and protect animals in need. Your adoption changes their lives.">
               Nous recueillons, soignons et protégeons les animaux dans le besoin.
            </p>
        </div>
    </section>

</main>

<?php include("footer.php"); ?>
