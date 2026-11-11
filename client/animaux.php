<?php 
$pageTitleFr = "Nos Ti'Animaux";
$pageTitleEn = "Our Animals"; 
include("header.php"); 
require_once "../serveur/dbFunctions.php"; 

$lang = $_COOKIE['lang'] ?? 'fr';
$filters = [
    'nom'    => $_GET['nom'] ?? '',
    'espece' => $_GET['espece'] ?? '',
    'race'   => $_GET['race'] ?? '',
    'sexe'   => $_GET['sexe'] ?? '',
    'statut'   => $_GET['statut'] ?? ''
];

$animals = getAllAnimals($filters);
$speciesList = getAllSpecies();
$raceList =  getAllRaces();
?>

<main>
    <section class="page-header">
        <div class="container">
            <h2 data-fr="Nos Animaux à Adopter" data-en="Our Animals for Adoption">Nos Animaux à Adopter</h2>
            <p data-fr="Découvrez tous nos pensionnaires qui attendent une famille aimante" data-en="Discover all our residents waiting for a loving family">Découvrez tous nos pensionnaires qui attendent une famille aimante</p>
        </div>
    </section>

    <section class="filter-section">
        <div class="container">
            <form method="GET" class="filter-form">
                <input type="text" name="nom" 
                    placeholder="<?= $lang === 'fr' ? 'Nom de l\'animal' : 'Animal Name' ?>" 
                    data-fr-placeholder="Nom de l'animal"
                    data-en-placeholder="Animal Name"
                    value="<?= htmlspecialchars($filters['nom']) ?>"
                >

                <select name="espece" id="especeSelect">
                    <option value="" data-fr="-- Espèce --" data-en="-- Species --">-- Espèce --</option>
                    <?php foreach ($speciesList as $esp) : ?>
                        <option value="<?= htmlspecialchars($esp['espece']) ?>" 
                                data-fr="<?= htmlspecialchars($esp['espece']) ?>" 
                                data-en="<?= htmlspecialchars($esp['espece_en']) ?>" 
                                <?= ($filters['espece'] === $esp['espece']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($esp['espece']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="race" id="raceSelect">
                    <option value="" data-fr="-- Race --" data-en="-- Breed --">-- Race --</option>
                    <?php foreach ($raceList as $r) : ?>
                        <option value="<?= htmlspecialchars($r['race']) ?>" 
                                data-fr="<?= htmlspecialchars($r['race']) ?>" 
                                data-en="<?= htmlspecialchars($r['race_en']) ?>" 
                                <?= ($filters['race'] === $r['race']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($r['race']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="sexe">
                    <option value="" data-fr="-- Sexe --" data-en="-- Sex --">-- Sexe --</option>
                    <option value="M" data-fr="M" data-en="M" <?= ($filters['sexe']==='M') ? 'selected' : '' ?>>M</option>
                    <option value="F" data-fr="F" data-en="F" <?= ($filters['sexe']==='F') ? 'selected' : '' ?>>F</option>
                </select>

                <select name="statut">
                    <option value="" data-fr="-- Statut --" data-en="-- Status --">-- Statut --</option>
                    <option value="Disponible" data-fr="Disponible" data-en="Available" <?= ($filters['statut']==='Disponible') ? 'selected' : '' ?>>Disponible</option>
                    <option value="Réservé" data-fr="Réservé·e" data-en="Reserved" <?= ($filters['statut']==='Réservé') ? 'selected' : '' ?>>Réservé·e</option>
                </select>

                <button type="submit" data-fr="Filtrer" data-en="Filter">Filtrer</button>
            </form>
        </div>
    </section>


    <section class="animals-grid">
        <div class="container">
            <div id="animalsContainer" class="grid">
                <?php
                if ($animals === false) {
                    echo "<p> Erreur lors de la récupération des animaux.</p>";
                } elseif (empty($animals)) {
                    echo "<p data-fr='Aucun animal pour le moment.' data-en='No animals at the moment.'>Aucun animal pour le moment.</p>";
                } else {
                    foreach ($animals as $animal) {
                        $reservedText = $lang === "en" ? "(Reserved)" : "(Réservé·e)";
                        $displayName = htmlspecialchars($animal['nomanimal']);
                        if ($animal['statut'] === "Réservé") {
                            $displayName .= " <span class='reserved'>$reservedText</span>";
                        }
                        ?>
                        <a href="animal.php?id=<?= $animal['idanimal'] ?>" class="animal-card">
                            <div class="photo">
                                <img src="<?= htmlspecialchars($animal['photourl']) ?>" alt="<?= htmlspecialchars($animal['nomanimal']) ?>">
                            </div>
                            <h3><?= $displayName ?></h3>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php include("footer.php"); ?>
