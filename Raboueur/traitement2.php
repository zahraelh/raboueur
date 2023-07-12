<?php
//Inclusion du fichier "constants.bdd.php" : Ce fichier contient les constantes nécessaires pour la connexion à la base de données.
include("./inc/constants.inc.php");

//Vérification de la méthode de la requête : Le code vérifie si la méthode de la requête est "POST". Cela signifie que le formulaire a été soumis.
//Récupération des données du formulaire : Les données du formulaire sont récupérées à l'aide de la superglobale $_POST. Chaque champ du formulaire est assigné à une variable correspondante.
// Traitement du formulaire de réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    $date_de_naissance = htmlspecialchars($_POST['date_de_naissance']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $code_postal = htmlspecialchars($_POST['code_postal']);
    $ville = htmlspecialchars($_POST['ville']);
 

    // Validation des données : Les données récupérées sont ensuite validées en fonction de certains critères, 
    //tels que la longueur minimale des champs, le format de l'e-mail, etc. Si des erreurs sont détectées, elles sont stockées dans le tableau $errors.
    $errors = [];

    // Validation du nom
    if (empty($nom)) {
        $errors['nom'] = "Veuillez entrer votre nom.";
    } elseif (!preg_match('/^[A-Za-z]{3,}+$/', $nom)) {
        $errors['nom'] = "Le nom doit contenir au moins 3 lettres et ne doit pas contenir de caractères spéciaux.";
    }

    // Validation du prénom
    if (empty($prenom)) {
        $errors['prenom'] = "Veuillez entrer votre prénom.";
    } elseif (!preg_match('/^[A-Za-z]{3,}+$/', $prenom)) {
        $errors['prenom'] = "Le prénom doit contenir au moins 3 lettres et ne doit pas contenir de caractères spéciaux.";
    }

    // Validation de l'e-mail
    if (empty($email)) {
        $errors['email'] = "Veuillez entrer votre adresse e-mail.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse e-mail n'est pas valide.";
    }

    // Validation du mot de passe
    if (empty($pass)) {
        $errors['pass'] = "Veuillez entrer l'adresse d'arrivée.";
    } elseif (!preg_match('/^[A-Za-z0-9_$]{8,}/', $pass)) {
        $errors['pass'] = "Le mot de passe n'est pas valide.";
    }

  // Validation de la date
  if (empty($date_de_naissance)) {
    $errors['date_de_naissance'] = "Veuillez entrer une date.";
} elseif (!preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $date_de_naissance)) {
    $errors['date_de_naissance'] = "La date doit être au format JJ-MM-AAAA.";
}

    // Validation de l'adresse
    if (empty($adresse)) {
        $errors['adresse'] = "Veuillez entrer une heure.";
    } elseif (!preg_match('/^[a-zA-Z0-9\s\.,-]+$/u', $adresse)) {
        $errors['adresse'] = "L'adresse est invalide.";
    }

    // Validation du code postal
    if (empty($code_postal)) {
        $errors['code_postal'] = "Veuillez entrer une heure.";
    } elseif (!preg_match('/^\d{5}$/', $code_postal)) {
        $errors['code_postal'] = "Le code postal est invalide.";
    }

     // Validation de la ville
     if (empty($ville)) {
        $errors['ville'] = "Veuillez entrer une heure.";
    } elseif (!preg_match('/^[a-zA-Z\s-]+$/u', $ville)) {
        $errors['ville'] = "La ville est invalide.";
    }

    // Affichage des erreurs : Si des erreurs sont présentes dans le tableau $errors, elles sont affichées à l'utilisateur.
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
    } else {
        // Si toutes les données sont valides
        // Effectuer les actions nécessaires, par exemple, enregistrer les données dans une base de données ou envoyer un e-mail de confirmation

        // Rediriger l'utilisateur vers une autre page après le traitement du formulaire
        header("Location:accueil.php");
        exit();
    }
}


//Récupération des valeurs saisies et application sécurité
foreach ($_POST as $key => $val) {
    $params[':' . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
}

// // Cryptage du mot de passe
// // $params[':pass']=sha1(md5($params[":pass"]) .md5($params[':pass']));
$params[':pass'] = password_hash($params[':pass'], PASSWORD_BCRYPT);


include_once("./inc/constants.inc.php");

try {
    // Connexion à la base de données : Le code se connecte à la base de données en utilisant les informations de connexion spécifiées dans le fichier "constants.bdd.php".
    $cnn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    // Options
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Vérification de l'existence de l'e-mail : Le code exécute une requête SQL pour vérifier si l'e-mail fourni lors de la réservation existe déjà dans la base de données. 
    // Si l'e-mail existe, un message d'erreur est affiché. Sinon, les données de réservation sont insérées dans la table "reservation_medicale" de la base de données.
    $sql = 'SELECT COUNT(*) AS nb FROM particulier WHERE email=?'; // paramètre anonyme
    $qry = $cnn->prepare($sql); // prépare la requête
    $qry->execute(array($email));
    $row = $qry->fetch();

    if ($row['nb'] == 1) {
        echo '<h2 class="reponse_mailexiste">Cet email existe déjà !';
        echo '<a href="connect_particulier.php">Retour au formulaire</a>';
    } else {
        $sql = 'INSERT INTO particulier(nom, prenom, email, pass, date_de_naissance, adresse, code_postal, ville) VALUES(:nom, :prenom, :email, :pass , :date_de_naissance, :adresse, :code_postal, :ville)';
        $qry = $cnn->prepare($sql);

        $params = [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':pass' => $pass,
            ':date_de_naissance' => $date_de_naissance,
            ':adresse' => $adresse,
            ':code_postal' => $code_postal,
            ':ville' => $ville
        ];
        //Fermeture des ressources : Après l'exécution de la requête, les curseurs et la connexion à la base de données sont fermés.
        $qry->execute($params);
        $qry = null; // Ferme le curseur de la requête
        $cnn = null; // Ferme la connexion à la base de données

        echo '<h2 class="reponse_mailexiste">Vous êtes bien inscrit ';
        echo '<a href="connect_particulier.php">Vous pouvez vous connecter et accéder à votre compte</a>';
    }
    //Gestion des exceptions : Si une exception de type PDOException est levée lors de la connexion à la base de données ou lors de l'exécution de la requête, le code capture l'exception, 
    //stocke le message d'erreur dans une variable, et enregistre les données de réservation dans la session pour une utilisation ultérieure.
} catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    $_SESSION["compte-erreur-sql"] = $errorMessage;
    $_SESSION["compte-donnees"]["nom"] = $nom;
    $_SESSION["compte-donnees"]["prenom"] = $prenom;
    $_SESSION["compte-donnees"]["email"] = $email;
    $_SESSION["compte-donnees"]["pass"] = $pass;
    $_SESSION["compte-donnees"]["date_de_naissance"] = $date_de_naissance;
    $_SESSION["compte-donnees"]["adresse"] = $adresse;
    $_SESSION["compte-donnees"]["code_postal"] = $code_postal;
    $_SESSION["compte-donnees"]["ville"] = $ville;
    exit;
}

?>
