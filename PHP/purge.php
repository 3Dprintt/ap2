<?php
// Paramètres de connexion à la base de données
$dsn = "mysql:host=localhost;dbname=u809795026_reservation";
$utilisateur = "u809795026_mathieu3";
$mot_de_passe = "Reservation1!";

try {
    // Connexion à la base de données
    $connexion = new PDO($dsn, $utilisateur, $mot_de_passe);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Définir la date limite de suppression
    $limite = date('Y-m-d', strtotime('-2 days'));

    // Requête pour supprimer les données antérieures à la date limite
    $sql = "DELETE FROM test WHERE date < :limite";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':limite', $limite);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Suppression réussie";
    } else {
        echo "Erreur de suppression";
    }
    
    // Fermer la connexion à la base de données
    $connexion = null;

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
header('Location: /AP2/PHP/AfficherAdmin.php');

?>
