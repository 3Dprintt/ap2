<?php
session_start();
if (!$_SESSION['email']) {
    header('Location: /AP2/PHP/connexion.php');
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/AP2/CSS/formulaire.css" media="screen" type="text/css" />
<head>
	<title>Réservation de salles</title>
</head>
<body>
	<h1>Réservation de salles</h1>
	<form method="POST" action="/AP2/PHP/reservation.php">
		<label for="nom">Nom:</label>
        <input type="text"name="Prenom" value="<?= $_SESSION['Nom']?>"><br><br>
        <input type="hidden"name="IDuser"  value="<?= $_SESSION['IDuser']?>">
        
        <label for="nom">Prénom:</label>
        <input type="text"name="Nom" value="<?= $_SESSION['Prenom']?>"><br><br>
        
		<label for="email">Email:</label>
		<input type="text" id="email" name="email"><br><br>
		
		<label for="date">Date:</label>
		<input type="date" id="date" name="date"><br><br>
		
        <label for="heure_debut">Heure de début :</label>
        <select id="heure_debut" name="heure_debut" required>

            <?php
            for ($heure = 8; $heure < 20; $heure++) {
                echo "<option value=\"$heure:00\">$heure:00</option>";
            }
            ?>
        </select>
        <br>
        <br>

        <label for="heure_fin">Heure de fin :</label>
        <select id="heure_fin" name="heure_fin" required>
            <?php
            for ($heure = 9; $heure <= 20; $heure++) {
                echo "<option value=\"$heure:00\">$heure:00</option>";
            }
            ?>
        </select>
        <br>
        <br>

		<div id="div_salle">
    <label for="salle">Salle :</label>
    <select name="IDsalle" id="salle">
    <?php
        try {
include("connexionDB.php");
// configuration des erreurs
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // préparation de la requête
            $query = $bdd->prepare("SELECT nomsalle,IDsalle FROM salle");
            // exécution de la requête
            $query->execute();
            // parcours des résultats
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$row['IDsalle'].'">'.$row['nomsalle'].'</option>';
            }
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    ?>
    </select>
</div>
<br>
<br>
		
<input type="submit" name="envoie">
</form>
<script language="javascript" src="/AP2/JS/test.js"></script>
</body>
</html>