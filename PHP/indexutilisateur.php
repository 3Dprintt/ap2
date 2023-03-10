<?php
include("connexionDB.php");
session_start();
if (!$_SESSION['email']) {
    header('Location: /AP1/PHP/connexion.php');
}

$afficher = $bdd ->prepare('SELECT u.Nom , u.Prenom , u.fonction , d.objetdemande , d.detailsdemande , d.secteur , d.intitule , d.etat , d.ID , d.technicien , d.IDusers , d.RaisonMEA
    FROM users u
    INNER JOIN demandeeffectuer d
    ON u.IDusers = d.IDusers
    WHERE d.technicien= "'.$_SESSION["Prenom"].'";');
$afficher->execute(array());
$user = $afficher->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Afficher les formulaires</title>
        <link rel="stylesheet" href="/AP2/CSS/Afficher.css" media="screen" type="text/css" />
        <a href="/AP1/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
    </head>
    <body>
    <h1>Voici vos taches a effectuer <?= $_SESSION['Prenom'];?>:</h1>
                   <br>
                   <br>     
                   <br>          
        <table border="2" align="center" width="50%">
        
            <tr>
            <th><B>Prénom</b></th><th>Nom</th><th>Fonction</th><th>objet de votre demande</th><th>details de votre demande</th><th>secteur</th><th>Priorité</th><th>état</th><th>technicien Assigner</th><th>modifié l'état</th><th>Mise en Attente</th>
            </tr>
                <?php foreach ($user as $cle => $value) { ?>
                <tr>
                <td><?php echo $value['Prenom'];?></td>
                <td><?php echo $value['Nom'];?></td>
                <td><?php echo $value['fonction'];?></td>
                <td><?php echo $value['objetdemande'];?></td>
                <td><?php echo $value['detailsdemande'];?></td>
                <td><?php echo $value['secteur'];?></td>
                <td><?php echo $value['intitule'];?></td>
                <td><?php echo $value['etat'];?></td>
                <td><?php echo $value['technicien'];?></td>
                <td><a href="/AP1/PHP/modifietechnicien.php?ID=<?php echo $value['ID']; ?>"><button id="bouton3">Modifier la demande</button></a></td>
                <td><a href="/AP1/PHP/MEA.php?ID=<?php echo $value['ID']; ?>"><button id="bouton3"> Raison Mise en attente  </button></a></td>
            
                </tr>
                <?php } ?>
        </table>
    </body>
</html>