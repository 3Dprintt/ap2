<?php
$servername = "localhost";
$username = "u809795026_mathieu3";
$password = "Reservation1!";
$dbname = "u809795026_reservation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Récupération des disponibilités des salles
$date = $_POST['date'];
$heure_debut = $_POST['heure_debut'];
$heure_fin = $_POST['heure_fin'];

$sql = "SELECT IDsalle,nomsalle FROM salle WHERE IDsalle NOT IN (SELECT IDsalle FROM test WHERE date = '$date' AND heure_debut >= '$heure_debut' AND heure_fin <= '$heure_fin')";
$result = mysqli_query($conn, $sql);

// Génération du menu select
echo "<label for='nomsalle'>Salle :</label>";
echo "<select id='nomsalle' name='IDsalle'>";
$result = $result->fetch_all();
if (count($result) > 0){
    foreach ($result as $key => $value) {
        echo "<option value=\"" . $value[0]  . "\">" . $value[1] . "</option>";
    }
}
else {
    echo "<option value=''>Aucune salle disponible</option>";
}
echo "</select>";

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>