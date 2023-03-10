<?php
try {
    // Connexion à la base de données
include("connexionDB.php");
$id_salle = $_GET['IDsalle'];
    // Préparation de la requête de suppression
    $stmt = $bdd->prepare("DELETE FROM salle WHERE IDsalle = $id_salle");

    // Vérification de la soumission du formulaire de suppression

        // Exécution de la requête de suppression
        $stmt->execute(array());

        // Vérification si la suppression a été effectuée
        if ($stmt->rowCount() > 0) {
            echo "La salle a été supprimée avec succès.";
        } else {
            echo "La salle n'a pas été trouvée.";
        }
    }
 catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
header('Location: /AP2/PHP/AfficherAdmin.php');

?>

