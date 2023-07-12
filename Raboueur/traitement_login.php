<?php 
// Regarde les données en POST
$email = ( isset( $_POST['email'] ) && !empty( $_POST['email'] ) ) ? htmlspecialchars( $_POST['email'] ) : null;
$pass = ( isset($_POST['pass']) && !empty($_POST['pass']) ) ? htmlspecialchars( $_POST['pass'] ) : null;

// if ($email && $pass) {
//     // ? Cryptage
//     $email = md5(md5($email) . strlen($email));
//     $pass = sha1(md5($pass) . md5($pass));
    
    // ? Connexion à la base de donnée
    try {
        // Connexion
        include_once("./inc/constants.login.php");
        $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DATA . ';port=' . PORT . ';charset=utf8', USER, PASS );
        // Gestion des attributs de connexion: Exception et retour du select
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Préparation de la requête
        $query = $conn->prepare('SELECT * FROM particulier WHERE email=? AND pass=? AND active=?');
        $query->execute(array($email, $pass, 1));
        // Si la ligne est trouvée
        if ($query->rowCount()===1) {
            $row = $query -> fetch();
            // Redirection
            header('location:particulier.php');
        } else {
            echo 'Utilisateur inconnu.';
        }
    } catch (PDOException $err) {
        echo $err->getMessage();
    }

?>


