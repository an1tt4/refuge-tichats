<?php
require_once "../serveur/dbFunctions.php";

$idAnimal = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $adresse = trim($_POST['adresse']);
    
    if ($nom && $prenom && $email && $telephone && $adresse && $idAnimal) {
        $adoptant = getAdoptantByEmail($email);
        $idAdoptant = $adoptant ? $adoptant['idadoptant'] : createAdoptant(
            $nom,
            $prenom,
            $email,
            $telephone,
            $adresse
        );
        
        if (createReservation($idAnimal, $idAdoptant)) {
            header("Location: reservationResult.php?status=success");
            exit;
        } else {
            header("Location: reservationResult.php?status=error");
            exit;
        }
    } else {
        header("Location: reservationResult.php?status=error");
        exit;
    }
}

$pageTitleFr = "Réservation";
$pageTitleEn = "Reservation";
include("header.php"); 
?>

<main>
    <section class="page-header">
        <div class="container">
            <h2 data-fr="Réservation" data-en="Reservation">Réservation</h2>
            <p data-fr="Remplissez le formulaire pour réserver cet animal"
                data-en="Fill the form to reserve this animal">
                Remplissez le formulaire pour réserver cet animal
            </p>
        </div>
    </section>
    
    <section class="reservation-form">
        <div class="container">
            <form action="reservation.php?id=<?= $idAnimal ?>" method="POST">
                <label for="nom" data-fr="Nom" data-en="Last Name">Nom</label>
                <input type="text" id="nom" name="nom" required>
                
                <label for="prenom" data-fr="Prénom" data-en="First Name">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
                
                <label for="email" data-fr="Email" data-en="Email">Email</label>
                <input type="email" id="email" name="email" required>
                
                <label for="telephone" data-fr="Téléphone" data-en="Phone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" required>
                
                <label for="adresse" data-fr="Adresse" data-en="Address">Adresse</label>
                <textarea id="adresse" name="adresse" required></textarea>
                
                <button type="submit" class="btn" 
                    data-fr="Réserver" 
                    data-en="Reserve">
                    Réserver
                </button>
            </form>
        </div>
    </section>
</main>

<?php include("footer.php"); ?>