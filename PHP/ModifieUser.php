<?php
include("connexionDB.php");
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $getid = $_GET['ID'];

    $recupdonnées = $bdd->prepare('SELECT * FROM test t INNER JOIN salle s on t.IDsalle = s.IDsalle WHERE ID = ? ');
    $recupdonnées->execute(array($getid));
    if ($recupdonnées->rowCount()>0) {
        $recupinfos = $recupdonnées->fetch();
        $date = $recupinfos['date'];
        $heure_debut = $recupinfos['heure_debut'];
        $heure_fin = $recupinfos['heure_fin'];
        $salle = $recupinfos['IDsalle'];

        
        if (isset($_POST['valider'])) {
            $salle = htmlspecialchars($_POST['IDsalle']);
            $date = htmlspecialchars($_POST['date']);
            $heure_debut = htmlspecialchars($_POST['heure_debut']);
            $heure_fin = htmlspecialchars($_POST['heure_fin']);

    
            $updatefichier = $bdd->prepare('UPDATE test SET IDsalle= ?, date= ?, heure_debut= ?, heure_fin=? WHERE ID = ?');
            $updatefichier->execute(array($salle,$date,$heure_debut,$heure_fin,$getid));

            header('Location: /AP2/PHP/AfficherUsers.php');
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
   <label for="date">Date:</label>
		<input type="date" id="date" name="date" value="<?php echo $recupinfos['date'] ?>" min="<?php echo date('Y-m-d'); ?>"><br><br>

<label for="heure_debut">Heure de début :</label>
        <select id="heure_debut" name="heure_debut" value="<?php echo $recupinfos['heure-debut'] ?>" required> 

            <?php
            for ($heure = 8; $heure < 20; $heure++) {
                echo "<option value=\"$heure:00\">$heure:00</option>";
            }
            ?>
        </select>
<br>
<br>

<label for="heure_fin">Heure de fin :</label>
        <select id="heure_fin" name="heure_fin" value="<?php echo $recupinfos['heure_fin'] ?>" required>
            <?php
            for ($heure = 9; $heure <= 20; $heure++) {
                echo "<option value=\"$heure:00\">$heure:00</option>";
            }
            ?>
        </select>
<br>
<br>
<div id="div_salle">
    <label for="salle">Salle disponible:</label>
    <select name="IDsalle" id="salle" value="<?php echo $recupinfos['nomsalle'] ?>">
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
   <input type="submit" name="valider">
</form>
<script language="javascript" src="/AP2/JS/test.js"></script>
</body>

</html>