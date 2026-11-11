<?php
require_once "db.php";

function getAnimalById($idAnimal) {
    global $conn;
    $res = pg_query_params($conn, "SELECT * FROM animal WHERE idanimal = $1", [$idAnimal]);
    return pg_fetch_assoc($res);
}

function getAllAnimals($filters = []) {
    global $conn;

    $where = [];
    $params = [];
    $i = 1;

    if (!empty($filters['nom'])) {
        $where[] = "nomanimal ILIKE $" . $i++;
        $params[] = '%' . $filters['nom'] . '%';
    }

    if (!empty($filters['espece'])) {
        $where[] = "espece = $" . $i++;
        $params[] = $filters['espece'];
    }

    if (!empty($filters['race'])) {
        $where[] = "race ILIKE $" . $i++;
        $params[] = '%' . $filters['race'] . '%';
    }

    if (!empty($filters['sexe'])) {
        $where[] = "sexe = $" . $i++;
        $params[] = $filters['sexe'];
    }

    if (!empty($filters['statut'])) {
        $where[] = "statut ILIKE $" . $i++;
        $params[] = $filters['statut'];
    }

    $whereSql = $where ? "WHERE " . implode(" AND ", $where) : "";
    $query = "SELECT * FROM animal $whereSql ORDER BY nomanimal ASC";
    $res = pg_query_params($conn, $query, $params);
    return $res ? pg_fetch_all($res) : false;
}

function getAllSpecies() {
    global $conn;
    $res = pg_query($conn, "SELECT espece, espece_en FROM animal GROUP BY espece, espece_en ORDER BY espece ASC");
    return $res ? pg_fetch_all($res) : [];
}

function getAllRaces() {
    global $conn;
    $res = pg_query($conn, "SELECT race, race_en FROM animal GROUP BY race, race_en ORDER BY race ASC");
    return $res ? pg_fetch_all($res) : [];
}

function getAdoptantByEmail($email) {
    global $conn;
    $res = pg_query_params($conn, "SELECT idadoptant FROM adoptant WHERE email = $1", [$email]);
    return pg_fetch_assoc($res);
}

function createAdoptant($nom, $prenom, $email, $telephone, $adresse) {
    global $conn;
    $res = pg_query_params($conn, "INSERT INTO adoptant (nom, prenom, email, telephone, adresse) VALUES ($1,$2,$3,$4,$5) RETURNING idadoptant", [$nom, $prenom, $email, $telephone, $adresse]);
    return pg_fetch_result($res, 0, 'idadoptant');
}

function addReservation($idAnimal, $idAdoptant) {
    global $conn;
    return pg_query_params($conn, "INSERT INTO reservation (idanimal, idadoptant, statut, datereservation) VALUES ($1,$2,'En attente', CURRENT_DATE)", [$idAnimal, $idAdoptant]);
}

function updateAnimalStatut($idAnimal, $statut) {
    global $conn;
    return pg_query_params($conn, "UPDATE animal SET statut = $1 WHERE idanimal = $2", [$statut, $idAnimal]);
}

function createReservation($idAnimal, $idAdoptant) {
    global $conn;
    pg_query($conn, "BEGIN");
    if (!addReservation($idAnimal, $idAdoptant) || !updateAnimalStatut($idAnimal, 'Réservé')) {
        pg_query($conn, "ROLLBACK");
        return false;
    }
    
    try {
        $redis = new Redis();
        if ($redis->connect('redis', 6379)) {
            $donnees_reservation = json_encode([
                'id_animal' => $idAnimal,
                'id_adoptant' => $idAdoptant,
                'date_creation' => date('Y-m-d H:i:s'),
                'type_evenement' => 'nouvelle_reservation'
            ]);
            
            $redis->lPush('historique_reservations', $donnees_reservation);
        }
    } catch (Exception $e) {
        error_log("Erreur Redis : " . $e->getMessage());
    }
    pg_query($conn, "COMMIT");
    return true;
}
function getRecentAnimals($limit = 3) {
    global $conn;
    $query = "SELECT * FROM animal ORDER BY datearrivee DESC LIMIT $1";
    $res = pg_query_params($conn, $query, [$limit]);
    return $res ? pg_fetch_all($res) : [];
}