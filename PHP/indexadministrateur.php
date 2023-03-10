<?php
session_start();
if(!$_SESSION['email']){
   header('Location: /AP2/PHP/connexion.php');
}
?>

<!doctype html>
<html>
    <head>
    <title>Acceuil Administrateur</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/AP2/CSS/index2.css" media="screen" type="text/css" />
    </head>
<body>
<div>
    <h1>Bienvenue sur votre espace <?php echo $_SESSION['Prenom'] ?> <br> Vous etes : <?php echo $_SESSION['fonction'] ?> </h1>
    <a href="/AP2/PHP/AfficherAdmin.php"><button id=bouton1>Afficher les réservations</button></a>
    <a href="/AP2/PHP/formulaire.php"><button id=bouton2>Afficher le formulaire </button></a>
    <a href="/AP2/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
</div>
</body>
</html>