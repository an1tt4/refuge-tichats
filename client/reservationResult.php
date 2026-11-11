<?php
$pageTitleFr = "Réservation";
$pageTitleEn = "Reservation";
include("header.php");

$status = $_GET['status'] ?? 'error';
?>

<main>
    <section class="page-header">
        <div class="container">
            <?php if ($status === 'success'): ?>
                <h2 class="success"
                    data-fr="Réservation réussie"
                    data-en="Reservation Successful">
                    Réservation réussie
                </h2>

                <p data-fr="Votre réservation a été enregistrée avec succès."
                   data-en="Your reservation has been successfully recorded.">
                   Votre réservation a été enregistrée avec succès.
                </p>

            <?php else: ?>
                <h2 class="error"
                    data-fr="Erreur"
                    data-en="Error">
                    Erreur
                </h2>

                <p data-fr="Un problème est survenu lors de la réservation."
                   data-en="An error occurred during the reservation.">
                    Un problème est survenu lors de la réservation.
                </p>
            <?php endif; ?>

            <a href="animaux.php" class="btn retour-btn"
                data-fr="Retour aux animaux"
                data-en="Back to animals">
                ← Retour aux animaux
            </a>
        </div>
    </section>
</main>

<?php include("footer.php"); ?>
