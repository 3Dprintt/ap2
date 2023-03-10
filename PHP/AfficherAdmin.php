<?php
include("connexionDB.php");
session_start();
if (!$_SESSION['email']) {
    header('Location: /AP2/PHP/connexion.php');
}

$afficher = $bdd ->prepare('SELECT nomsalle , IDsalle
    FROM salle ');
$afficher->execute(array());
$user = $afficher->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Afficher les salles</title>
        <link rel="stylesheet" href="/AP2/CSS/Afficher.css" media="screen" type="text/css" />
        <a href="/AP2/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
        <a href="/AP2/PHP/purge.php"><button id=boutonpurge>supprimer les anciennes données</button></a>
        <br><br><br><br><br>
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
                    <td><a href="/AP2/PHP/modifie.php?IDsalle=<?php echo $value['IDsalle']; ?>"><button id="bouton3" align="center">Modifier cette salle</button></a></td>


                </tr>
                <?php } ?>
        </table>
        </div>


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

        <script>
           // Récupérer le tableau à trier
var table = document.getElementById("tableau");

// Récupérer les lignes du tableau à trier
var rows = table.getElementsByTagName("tr");

// Créer un tableau vide pour stocker les données de chaque ligne
var rowData = [];

// Stocker les en-têtes de colonnes dans un tableau séparé
var headers = [];
var headerRow = rows[0];
var headerCells = headerRow.getElementsByTagName("th");
for (var i = 0; i < headerCells.length; i++) {
  headers.push(headerCells[i].innerHTML);
}

// Parcourir chaque ligne du tableau
for (var i = 1; i < rows.length; i++) {

  // Récupérer les cellules de la ligne
  var cells = rows[i].getElementsByTagName("td");

  // Stocker les données de chaque cellule dans le tableau rowData
  var rowValues = [];
  for (var j = 0; j < cells.length; j++) {
    rowValues.push(cells[j].innerHTML);
  }

  rowData.push(rowValues);
}

// Trier les données dans l'ordre alphabétique (en fonction de la première colonne)
rowData.sort(function(a, b) {
  return a[0].localeCompare(b[0]);
});

// Vider le tableau existant
while (table.firstChild) {
  table.removeChild(table.firstChild);
}

// Ajouter les en-têtes de colonnes au tableau
var headerRow = table.insertRow(0);
for (var i = 0; i < headers.length; i++) {
  var newHeaderCell = headerRow.insertCell(i);
  newHeaderCell.innerHTML = headers[i];
}

// Ajouter les lignes triées au tableau
for (var i = 0; i < rowData.length; i++) {
  var newRow = table.insertRow(i+1);
  for (var j = 0; j < rowData[i].length; j++) {
    var newCell = newRow.insertCell(j);
    newCell.innerHTML = rowData[i][j];
  }
}


        </script>
<input class="zoneSaisie" type="search" placeholder="Recherche par état d'avancement" id="maRecherche" onkeyup="filtrer()">
        
    </body>
</html>
