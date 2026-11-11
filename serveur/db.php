<?php
require_once "config.php";

$conn = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

if (!$conn) {
    die("Erreur de connexion à PostgreSQL");
}
