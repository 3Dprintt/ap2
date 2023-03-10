<?php
include("connexionDB.php");
session_start();
if (!$_SESSION['email']) {
    header('Location: /AP2/PHP/connexion.php');
}

$afficher = $bdd ->prepare('SELECT nomsalle , IDsalle
    FROM salle ');
    /*INNER JOIN indicepriorité i
    ON u.IDusers = i.intitulé');
    /*INNER JOIN étatdemande
    ON users.IDusers = étatdemande.IDétat'); */
$afficher->execute(array());
$user = $afficher->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Afficher les salles</title>
        <link rel="stylesheet" href="/AP2/CSS/Afficher.css" media="screen" type="text/css" />
        <a href="/AP2/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
    </head>
    <body>
        
        <div>
        <table border="2" align="center" width="50%" class="tableau" id="tableau">
        <h1>Voici toutes les salles de M2L <?= $_SESSION['Prenom'];?> :</h1>
            <tr>
            <th><B>Nom de la salle </b></th><th><b>Consulter les reservations</b></th><th><b>Supprimer la salle</b></th><th><b>Modifier la salle</b></th>
            </tr>
                <?php foreach ($user as $cle => $value) { ?>
                <tr>
                    <td><?php echo $value['nomsalle'];?></td>
                    <td><a href="/AP2/PHP/infssalle.php?IDsalle=<?php echo $value['IDsalle']; ?>"><button id="bouton3" align="center">Afficher les réservations de cette salle</button></a></td>
                    <td><a href="/AP2/PHP/delete.php?IDsalle=<?php echo $value['IDsalle']; ?>"><button id="bouton3" align="center">Supprimer cette salle</button></a></td>
                    <td><a href="/AP2/PHP/update.php?IDsalle=<?php echo $value['IDsalle']; ?>"><button id="bouton3" align="center">Modifier cette salle</button></a></td>


                </tr>
                <?php } ?>
        </table>
        </div>
<input class="zoneSaisie" type="search" placeholder="Recherche par état d'avancement" id="maRecherche" onkeyup="filtrer()">

        <script>
        function filtrer()
        {
            var filtre, tableau, ligne, cellule, i, texte // déclare les variables utilisées

            filtre = document.getElementById("maRecherche").value.toUpperCase(); // on dit a quoi sa correspond
            tableau = document.getElementById("tableau");
            ligne = tableau.getElementsByTagName("tr");
            
            for(i=0; i<ligne.length; i++)
            {
                cellule = ligne[i].getElementsByTagName("td") [0];
                if(cellule)
                {
                    texte = cellule.innerText;
                    if(texte.toUpperCase().indexOf(filtre) > -1)
                    {
                        ligne[i].style.display = "";
                    }
                    else
                    {
                        ligne[i].style.display = "none";
                    }
                }
            }
        }
                    
        </script>
        
        
    </body>
</html>
