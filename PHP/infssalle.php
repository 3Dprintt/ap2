<?php

session_start();
if(!$_SESSION['email']){
   header('Location: /AP2/PHP/connexion.php');
}

include("connexionDB.php");
// Récupération de l'ID de la salle depuis l'URL
$id_salle = $_GET['IDsalle'];

// Récupération des réservations pour la salle en question sur les 7 prochains jours
$date_min = date('Y-m-d');
$date_max = date('Y-m-d', strtotime('+7 days'));
$sql = "SELECT * FROM test t INNER JOIN users u ON u.IDuser = t.IDuser WHERE IDsalle = $id_salle AND date BETWEEN '$date_min' AND '$date_max' ORDER BY date ASC, heure_debut ASC";
$resultat = $bdd->query($sql);

// Affichage des réservations dans un tableau
echo "<table>";
echo "<tr><th>Date</th><th>Heure de début</th><th>Heure de fin</th><th>Prénom du réservateur</th><th>Prénom du réservateur</th></tr>";
while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['heure_debut'] . "</td>";
    echo "<td>" . $row['heure_fin'] . "</td>";
    echo "<td>" . $row['Prenom'] . "</td>";
    echo "<td>" . $row['Nom'] . "</td>";

    echo "</tr>";
}
echo "</table>";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Afficher les formulaires</title>
        <link rel="stylesheet" href="/AP2/CSS/Afficher.css" media="screen" type="text/css" />
        <a href="/AP1/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
    </head>
</html>