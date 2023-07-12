<?php
include("./inc/constants.inc.php");


session_start();

//vérifier le jéton CSRF - à faire
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';  
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$date_de_naissance = isset($_POST['date_de_naissance']) ? $_POST['date_de_naissance'] : '';
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
$code_postal = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';
$ville = isset($_POST['ville']) ? $_POST['ville'] : '';

//Initialiser le tableau $erreurs
$erreurs = [];
//2.valider les données
//  valider le nom
  if(preg_match("/^[A-Za-z]+$/", $nom) === 0){
    //ajouter un message d'erreur dans le tableau $erreurs
    $erreurs["nom"] = "le nom n'est pas valide";
  }
  //valider le prenom
  if(preg_match("/^[A-Za-z]+$/", $prenom)=== 0){
    //ajouter un message d'erreur dans le tableau $erreurs
    $erreurs["prenom"] = "le prénom n'est pas valide";
  }
   //valider email
   if(preg_match("/^[A-Za-zÀ-ú]{1,}@/", $email)=== 0){
    //ajouter un message d'erreur dans le tableau $erreurs
    $erreurs["email"] = "l'email n'est pas valide";
  }
  //valider $pass
  if(preg_match("/^[A-Za-z0-9_$]{8,}/", $pass)=== 0){
    //ajouter un message d'erreur dans le tableau $erreurs
    $erreurs["pass"] = "le mot de passe n'est pas valide";
  }
  //valider la date de naissance
  if(preg_match('/^\d{8}$/', $date_de_naissance)=== 0){
     //ajouter un message d'erreur dans le tableau $erreurs
     $erreurs["date_de_naissance"] = "le mot de passe n'est pas valide";
  }
  // Validation de l'adresse
  if (empty($adresse)) {
    echo "L'adresse ne peut pas être vide.";
  }
   //valider le code_postal
   if(preg_match('/^\d{5}$/', $code_postal)=== 0){
    //ajouter un message d'erreur dans le tableau $erreurs
    $erreurs["code_postal"] = "le code postal doit comporte 5 chiffres";
  }
   //valider la ville
   if(preg_match('/^[a-zA-Z\s-]+$/u', $ville)=== 0){
    //ajouter un message d'erreur dans le tableau $erreurs
    $erreurs["ville"] = "le code postal doit comporte 5 chiffres";
  }
  //3.mette en place la protection contre l'attaque XSS (failles)
  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $email = htmlspecialchars($email);
  $pass = htmlspecialchars($pass);
  $date_de_naissance = htmlspecialchars($date_de_naissance);
  $adresse = htmlspecialchars($adresse);
  $code_postal = htmlspecialchars($code_postal);
  $ville = htmlspecialchars($ville);

//4.si echec de validation,
  //rediriger vers la page de formulaire avec des messages d'erreur et les données saisies
  if (count($erreurs) > 0) {//si le tableau $erreurs n'est pas vide
    $_SESSION["compte-donnees"]["nom"] = $nom;
    $_SESSION["compte-donnees"]["prenom"] = $prenom;
    $_SESSION["compte-donnees"]["email"] = $email;
    $_SESSION["compte-donnees"]["pass"] = $pass;
    $_SESSION["compte-donnees"]["date_de_naissance"] = $date_de_naissance;
    $_SESSION["compte-donnees"]["adresse"] = $adresse;
    $_SESSION["compte-donnees"]["code_postal"] = $code_postal;
    $_SESSION["compte-donnees"]["ville"] = $ville;
    $_SESSION["compte-erreurs"] = $erreurs;
    // header("location: compte.php");//redirection avec le code HTTP 302
    echo '<h2 class="reponse_mailexiste">vous n avez pas rempli tous les champs  ';
    echo '<a href="connect_particulier.php">Retour au formulaire</a>';
    exit;
  }
/******************************** */
//Récupération des valeurs saisies et application sécurité
foreach ($_POST as $key => $val) {
    $params[':' . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
}

// Crypte email et mot de passe
$params[':email'] = md5(md5($params[':email']) . strlen($params[':email']));
$params[':pass'] = sha1(md5($params[':pass']) . md5($params[':pass']));

// var_dump($_POST);
// var_dump($params);


include_once('./inc/constants.inc.php');
try {
   // Connexion à la BDD
    $cnn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    // Options
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // Teste si le nom n'existe pas déjà
    $sql = 'SELECT COUNT(*) AS nb FROM particulier WHERE email=?'; // paramètre anonyme
    $qry = $cnn->prepare($sql); // prépare la requête
    $qry->execute(array($params[':email']));
    $row = $qry->fetch();
    //var_dump($row);
    if ($row['nb'] == 1) {
        echo '<h2 class="reponse_mailexiste">Cet email existe déjà !';
      echo '<a href="accueil.php">Retour à l\'accueil</a>';
        // header("location:compte.php");
    } else {
        $sql = 'INSERT INTO particulier(nom, prenom, email, pass, date_de_naissance, adresse, code_postal, ville) VALUES(:nom, :prenom, :email, :pass , :date_de_naissance, :adresse, :code_postal, :ville)';
        $qry = $cnn->prepare($sql);
        $qry->execute($params);
        unset($cnn); // déconnexion
        // header('location:login.php?m=inscription');
            // header('location:textes.php');
        echo '<h2 class="reponse_mailexiste">Vous etes bien inscrit ';
        echo '<a href="accueil.php">Retour à de connexion</a>';
        // header('location:textes.php');
        
    }
  } catch (PDOException $ex) {
    // $ex contient l'exception capturée
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
        // header("location: compte.php");//redirection avec le code HTTP 302
        exit;
}
?>
