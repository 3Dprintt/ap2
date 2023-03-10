<?php
include("connexionDB.php");
session_start();
if (!$_SESSION['email']) {
    header('Location: /AP2/PHP/connexion.php');
}

$afficher = $bdd ->prepare('SELECT *
    FROM users u
    INNER JOIN test t
    ON u.IDuser = t.IDuser
    INNER JOIN salle s
    ON t.IDsalle = s.IDsalle
    WHERE t.IDuser= "'.$_SESSION["IDuser"].'";');
$afficher->execute(array());
$user = $afficher->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Afficher les formulaires</title>
        <link rel="stylesheet" href="/AP2/CSS/Afficher.css" media="screen" type="text/css" />
        <a href="/AP2/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
    </head>
    <body>
    <h1>Voici vos reservations <?= $_SESSION['Prenom'];?>:</h1>
                   <br>
                   <br>     
                   <br>          
        <table border="2" align="center" width="50%">
        
            <tr>
            <th><B>Prenom</b></th><th>Nom</th><th>email</th><th>date</th><th>Heure_debut</th><th>Heure_fin</th><th>salle réserver</th><th>Modifier ma reservation</th><th>Supprimer ma reservation</th>
            </tr>
                <?php foreach ($user as $cle => $value) { ?>
                <tr>
                <td><?php echo $value['Prenom'];?></td>
                <td><?php echo $value['Nom'];?></td>
                <td><?php echo $value['email'];?></td>
                <td><?php echo $value['date'];?></td>
                <td><?php echo $value['heure_debut'];?></td>
                <td><?php echo $value['heure_fin'];?></td>
                <td><?php echo $value['nomsalle'];?></td>


                <td><a href="/AP2/PHP/ModifieUser.php?ID=<?php echo $value['ID']; ?>"><button id="bouton3">Modifier ma reservation</button></a></td>
                <td><a href="/AP2/PHP/deleteuser.php?ID=<?php echo $value['ID']; ?>"><button id="bouton3">Supprimer ma reservation</button></a></td>
            
                </tr>
                <?php } ?>
        </table>
    </body>
</html>