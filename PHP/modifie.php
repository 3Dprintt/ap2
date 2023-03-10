<?php
include("connexionDB.php");
if (isset($_GET['IDsalle']) && !empty($_GET['IDsalle'])) {
    $getid = $_GET['IDsalle'];

    $recupdonnées = $bdd->prepare('SELECT * FROM salle WHERE IDsalle = ? ');
    $recupdonnées->execute(array($getid));
    if ($recupdonnées->rowCount()>0) {
        $recupinfos = $recupdonnées->fetch();
        $salle = $recupinfos['nomsalle'];
        
        if (isset($_POST['valider'])) {
            $salle = htmlspecialchars($_POST['salle']);
    
            $updatefichier = $bdd->prepare('UPDATE salle SET nomsalle= ? WHERE IDsalle = ?');
            $updatefichier->execute(array($salle,$getid));

            header('Location: /AP2/PHP/AfficherAdmin.php');
            exit();
        }
        
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Modifier mes données</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/AP2/CSS/formulaire.css" media="screen" type="text/css" />
    <h1>Modifier vos données</h1>
    <a href="/AP2/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
 </head>

<body>
   <form  method="POST" action="">
   <br><br>
   <label for="etats">Modifié le nom de la salle : </label>
   <?php
echo '<input type="text" name="salle" value="' . $salle . '"/>';   
?>
<br>
   <input type="submit" name="valider">
</form>
</body>

</html>