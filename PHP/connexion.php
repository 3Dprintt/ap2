<?php
include("connexionDB.php");if (isset($_POST['envoi'])) {
    if (!empty($_POST['email']) && !empty($_POST['Password'])) {  // paramatre nécessaire
        $email = htmlspecialchars($_POST['email']);
        $password =htmlspecialchars($_POST['Password']);

        echo $email;
        echo "<br/>";
        echo $password;

        $recupUser = $bdd->prepare('
            SELECT *
            FROM users
            WHERE email = ?
            AND Password = ?'); // on recupere les parametres nécessaire
        $recupUser->execute(array($email, $password));
        
        if ($recupUser->rowCount() > 0) {
            session_start();
            $line=$recupUser->fetch();
            $_SESSION['Nom'] = $line['Nom'];
            $_SESSION['Prenom'] = $line['Prenom'];
            $_SESSION['fonction'] = $line['fonction'];
            $_SESSION['email'] = $line['email'];
            $_SESSION['IDuser'] = $line['IDuser'];
            header('Location:/AP2/PHP/index'. $_SESSION['fonction'].'.php');
            exit();
        }else {
            echo "votre mot de passe ou pseudo est incorrect";
        }
    }else {
        echo "veuillez compléter tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Interface de connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/AP2/CSS/connexion.css" media="screen" type="text/css" />
</head>
<body>
    <center>
        <form action="" method="POST"  align="center">
            <h1>Interface de connexion</h1>
            <br>

            <h4>Email</h2>
                <input type="text" name="email" autocomplete="0ff">

            <h4>Password</h2>
                <input type="password" name="Password">
            <br>
            <br>

                <input type="submit" name="envoi">
        </form>
    </center>
</body>
</html>