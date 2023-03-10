<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['envoie'])) {
    $nom = ($_POST['IDuser']);
    $email = htmlspecialchars($_POST['email']);
    $salle = ($_POST ['IDsalle']);
    $date = htmlspecialchars($_POST['date']);
    $heure_debut = htmlspecialchars($_POST['heure_debut']);
    $heure_fin = htmlspecialchars($_POST['heure_fin']);

    print_r($_POST);

    try {
        include("connexionDB.php");
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    $req = $bdd->prepare('SELECT COUNT(*) FROM test WHERE IDsalle = :IDsalle AND date = :date AND ((heure_debut <= :heure_debut AND heure_fin >= :heure_debut) OR (heure_debut <= :heure_fin AND heure_fin >= :heure_fin) OR (heure_debut >= :heure_debut AND heure_fin <= :heure_fin))');
    
    $req->execute(array(
        'IDsalle' => $salle,
        'date' => $date,
        'heure_debut' => $heure_debut,
        'heure_fin' => $heure_fin
    ));

    $nb_reservations = $req->fetchColumn();

    if($nb_reservations > 0) {
        echo "La salle est déjà réservée pour cette période.";
    } else {
        $req = $bdd->prepare('INSERT INTO test(IDuser, email, date, heure_debut, heure_fin, IDsalle) VALUES(:IDuser, :email, :date, :heure_debut, :heure_fin, :IDsalle)');
        
        $req->execute(array(
            'IDuser' => $nom,
            'email' => $email,
            'date' => $date,
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin,
            'IDsalle' => $salle
        ));

        echo "La réservation a été effectuée avec succès.";
    }
}
?>