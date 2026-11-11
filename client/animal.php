<?php
$pageTitleFr = "Fiche Animal";
$pageTitleEn = "Animal Profile";
include("header.php");
require_once "../serveur/db.php"; 

$lang = $_COOKIE["lang"] ?? "fr";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Erreur : Animal non trouvé.</p>";
    include("footer.php");
    exit;
}

$idAnimal = (int)$_GET['id'];

$query = "SELECT * FROM animal WHERE idanimal = $1";
$result = pg_query_params($conn, $query, array($idAnimal));

if (!$result || pg_num_rows($result) == 0) {
    echo "<p>Erreur : Animal non trouvé.</p>";
    include("footer.php");
    exit;
}

$animal = pg_fetch_assoc($result);

$statutFR = $animal['statut'];
$statutEN = $animal['statut_en'] ?? $animal['statut'];

$isReserved = ($statutFR === "Réservé" || $statutEN === "Reserved");
?>

<main>
    <section class="animal-profile">
        <div class="container">
            <h2><?= htmlspecialchars($animal['nomanimal']) ?></h2>
            <div class="profile-grid">
                <div class="photo">
                    <img src="<?= htmlspecialchars($animal['photourl']) ?>" alt="<?= htmlspecialchars($animal['nomanimal']) ?>">
                </div>
                <div class="details">
                    <p>
                        <strong data-fr="Espèce" data-en="Species">Espèce:</strong> 
                        <span class="animal-data" data-fr="<?= htmlspecialchars($animal['espece']) ?>" data-en="<?= htmlspecialchars($animal['espece_en'] ?? $animal['espece']) ?>">
                            <?= htmlspecialchars($animal['espece']) ?>
                        </span>
                    </p>
                    <p>
                        <strong data-fr="Race" data-en="Breed">Race:</strong> 
                        <span class="animal-data" data-fr="<?= htmlspecialchars($animal['race']) ?>" data-en="<?= htmlspecialchars($animal['race_en'] ?? $animal['race']) ?>">
                            <?= htmlspecialchars($animal['race']) ?>
                        </span>
                    </p>
                    <p>
                        <strong data-fr="Sexe" data-en="Sex">Sexe:</strong> 
                        <span class="animal-data" data-fr="<?= htmlspecialchars($animal['sexe']) ?>" data-en="<?= htmlspecialchars($animal['sexe']) ?>">
                            <?= htmlspecialchars($animal['sexe']) ?>
                        </span>
                    </p>
                    <p>
                        <strong data-fr="Statut" data-en="Status">Statut:</strong> 
                        <span class="animal-data" data-fr="<?= htmlspecialchars($statutFR) ?>" data-en="<?= htmlspecialchars($statutEN) ?>">
                            <?= htmlspecialchars($statutFR) ?>
                        </span>
                    </p>
                    <p>
                        <strong data-fr="Date d'arrivée" data-en="Arrival date">Date d'arrivée:</strong> 
                        <span class="animal-data" data-fr="<?= htmlspecialchars($animal['datearrivee']) ?>" data-en="<?= htmlspecialchars($animal['datearrivee']) ?>">
                            <?= htmlspecialchars($animal['datearrivee']) ?>
                        </span>
                    </p>
                    <p class="description">
                        <span class="animal-data" data-fr="<?= nl2br(htmlspecialchars($animal['description'])) ?>" data-en="<?= nl2br(htmlspecialchars($animal['description_en'] ?? $animal['description'])) ?>">
                            <?= nl2br(htmlspecialchars($animal['description'])) ?>
                        </span>
                    </p>
                </div>
            </div>

            <?php if (!$isReserved) : ?>
                <a href="reservation.php?id=<?= $animal['idanimal'] ?>" class="btn" data-fr="Réserver" data-en="Reserve">Réserver</a>
            <?php endif; ?>

            <a href="animaux.php" class="btn" data-fr="Retour à la liste" data-en="Back to list">← Retour à la liste</a>
        </div>
    </section>
</main>

<?php include("footer.php"); ?>
