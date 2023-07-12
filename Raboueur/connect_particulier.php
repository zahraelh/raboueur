<?php
include ("header.php")
?>
    <main>
        <div class="connection-container">
            <div class="connection-box">
                <h1 class="section-title">Connexion</h1>
                <form class="connection-form" action="traitement_login.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="login-email" required class="text-field field-required <?php if(isset($emailMsgErreur) && !empty($emailMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="emailFeedback"  >
                    <?php if(isset($emailMsgErreur)){      ?>
                    <div class="invalid-feedback" id="emailFeedback">
                        <?php echo $emailMsgErreur; ?> 
                    </div>
                    <?php } ?>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="pass" id="login-password"  pattern="[A-Za-z0-9_$]{8,}" required class="text-field field-required <?php if(isset($passMsgErreur) && !empty($passMsgErreur)) echo 'is-invalid'; ?> "aria-describedby="passFeedback" >
                     <?php if(isset($passMsgErreur)){                  ?>
                    <div class="invalid-feedback" id="passFeedback">
                        <?php echo $passMsgErreur; ?>
                    </div>
                    <?php } ?>
                    <input type="submit" value="Se connecter" id="login-button">
                </form>
            </div>
            <div class="images-connexion">
                <img src="img/dechets1.jpg">
                <img src="img/dechets2.png">
                <img src="img/dechets3.jpg">
            </div>
        </div>
        <div class="register-box">
            <h1 class="section-title">Inscription</h1>
            <form class="register-form" action="traitement2.php" method="POST">
                <div id="register-left side">
                    <label for="last-name">Nom</label>
                    <input type="text" name="nom" id="register-last-name" required  pattern="/^[A-Za-z]{3,}+$/" class="text-field field-required <?php if(isset($nomMsgErreur) && !empty($nomMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="nomFeedback" >
                   <?php if(isset($nomMsgErreur)){  ?>
                    <div class="invalid-feedback" id="nomFeedback">
                       <?php echo  $nomMsgErreur; ?> 
                    </div> <?php } ?>
                   
                    <label for="first-name">Prénom</label>
                    <input type="text" name="prenom" id="register-first-name" required pattern="/^[A-Za-z]{3,}+$/" class="text-field field-required <?php if(isset($prenomMsgErreur) && !empty($prenomMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="prenomFeedback"  >
                   <?php if(isset($prenomMsgErreur)){      ?>
                    <div class="invalid-feedback" id="prenomFeedback"> 
                      <?php echo  $prenomMsgErreur; ?>
                    </div> <?php } ?>
                </div>
                <div id="register-left side">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="register-email" required class="text-field field-required <?php if(isset($emailMsgErreur) && !empty($emailMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="emailFeedback"  >
                   <?php if(isset($emailMsgErreur)){      ?>
                   <div class="invalid-feedback" id="emailFeedback"> 
                     <?php echo  $emailMsgErreur; ?>
                   </div> 
                   <?php } ?>
                    
                   <label for="birth-date">Date de naissance</label>
                    <input type="date" name="date_de_naissance" id="birth-date-field" required class="text-field field-required <?php if(isset($date_de_naissanceMsgErreur) && !empty($date_de_naissanceMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="date_de_naissanceFeedback" >
                   <?php if(isset($date_de_naissanceMsgErreur)){                  ?>

                    <div class="invalid-feedback" id="date_de_naissanceFeedback">
                      <?php echo  $date_de_naissanceMsgErreur; ?>
                    </div>  <?php } ?> 

                <div id="register-left side2">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="pass" id="register-password" required class="text-field field-required <?php if(isset($passMsgErreur) && !empty($passMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="passFeedback" >
                   <?php if(isset($passMsgErreur)){                  ?>
                   <div class="invalid-feedback" id="passFeedback">
                     <?php echo  $passMsgErreur; ?>
                   </div>
                   <?php } ?>
               
                    <label for="password">Confirmer le mot de passe</label>
                    <input type="password"  id="register-password" required class="text-field field-required" pattern="[A-Za-z0-9_$]{8,}" >
                </div>

                <div id="register-right-side">
                    <div id="right-side-top">
                        <!-- <div class="city"> -->
                            <label for="city">Adresse</label>
                            <input type="text" name="adresse" id="city-field" required class="text-field field-required <?php if(isset($adresseMsgErreur) && !empty($adresseMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="adresseFeedback" >
                            <?php if(isset($adresseMsgErreur)){                  ?>

                                <div class="invalid-feedback" id="adresseFeedback">
                                <?php echo  $adresseMsgErreur; ?>
                                </div>  <?php } ?> 

                            <label for="city">Code postal</label>
                            <input type="text" name="code_postal" id="city-field" required class="text-field field-required <?php if(isset($code_postalMsgErreur) && !empty($code_postalMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="code_postalFeedback" >
                            <?php if(isset($code_postalMsgErreur)){                  ?>

                                <div class="invalid-feedback" id="code_postalFeedback">
                                <?php echo  $code_postalMsgErreur; ?>
                                </div>  <?php } ?> 

                            <label for="city">Ville</label>
                            <input type="text" name="ville" id="city-field" required class="text-field field-required <?php if(isset($villeMsgErreur) && !empty($villeMsgErreur)) echo 'is-invalid'; ?>" aria-describedby="villeFeedback" >
                            <?php if(isset($villeMsgErreur)){                  ?>

                                <div class="invalid-feedback" id="villeFeedback">
                                <?php echo  $villeMsgErreur; ?>
                                </div>  <?php } ?> 
                    </div>

                    <div id="register-right-side">
                            <input type="submit" value="Créer un compte" id="register-button">
                    </div>
                   
                    <p>Note de Rémy: Je te recommande de créer un mot de passe fort pour protéger ton compte des intrus !
                        8 caractères au minimum puis des chiffres et des lettres.
                        Pense aussi à utiliser des majuscules !
                    </p>
                </div>
            </form>
        </div>
    </main>
<?php
include ("footer.php")
?>