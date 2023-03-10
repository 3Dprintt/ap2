<?php
include("connexionDB.php");
session_start();
if (!$_SESSION['email']) {
    header('Location: /AP1/PHP/connexion.php');
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Afficher les formulaires</title>
        <link rel="stylesheet" href="/AP2/CSS/Afficher.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="/AP2/CSS/index2.css" media="screen" type="text/css" />

        <div>
        <h1>Bienvenue sur votre espace <?php echo $_SESSION['Prenom'] ?> <br> Vous etes : <?php echo $_SESSION['fonction'] ?> </h1>
        <a href="/AP2/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
        <a href="/AP2/PHP/formulaire.php"><button id=bouton2>Afficher le formulaire </button></a>
        <a href="/AP2/PHP/AfficherUsers.php"><button id=bouton3>Afficher mes reservations</button></a>

        </div>
            
    </head>
    <body>
    </body>
</html>