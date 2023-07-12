<?php
include ("header.php")
?>
    <main>
        <section class="procontainer">
            <section class="fenetre-connexionpro">
                <h1 class="connecter">Se connecter</h1>
                    <form action="#" class="connexionpro">          
                        <label>Nom d'utilisateur</label>
                        <input type="text" class="text">
                        <label>Mot de passe</label>
                        <input type="password" class="text">
                        <button class="connexion-pro">Connexion</button>
                    </form>
            </section>
            <section class="carte">
                <iframe class="maps" src="https://www.google.com/maps/d/embed?mid=1Ia9SO8NDsrlIgmurMG5flbi2C5pK9NU&ehbc=2E312F" ></iframe>
            </section>
        </section>
        <section class="containerpro2">
                <h2 class="missions">MISSIONS:</h2>
                <article class="article1">
                    <article class="article-pro">

                        <div>
                            <figure class="snip1487">
                                <img src="dechetenborddeloise.jpg" alt=" déchet en bord de l'Oise" class="images" >
                                <figcaption>
                                    <h3>Sac d'ordures en bord de l'Oise</h3>
                                  </figcaption><i class="fa-solid fa-link" style="color: #5a8ce2;"></i>
                                  <a href="#"></a>
                            </figure>
                        </div>   
                    </article>
                    <article class="article-pro">
                        <div>
                            <figure class="snip1487">
                                <img src="objetsurlaroute.jpg" alt="objet sur la route" class="images">
                                <figcaption>
                                    <h3>Objet sur la route nationale 42 N22</h3>
                                  </figcaption><i class="fa-solid fa-link" style="color: #5a8ce2;"></i>
                                  <a href="#"></a>
                            </figure>
                        </div>
                    </article>
                    <article class="article-pro">
                        <div>
                            <figure class="snip1487">
                                <img src="title-1576680650.jpg" alt="objet sur la route" class="images">
                                <figcaption>
                                    <h3>Déchets prés des containers à ordures</h3>
                                  </figcaption><i class="fa-solid fa-link" style="color: #5a8ce2;"></i>
                                  <a href="#"></a>
                            </figure>
                        </div>
                    </article>
                    <article class="article-pro">
                        <div>
                            <figure class="snip1487">
                                <img src="ob_120a02_de-pot-sauvage-2a.jpg" alt="dépôts sauvages" class="images">
                                <figcaption>
                                    <h3>Dépôts sauvages</h3>
                                  </figcaption><i class="fa-solid fa-link" style="color: #5a8ce2;"></i>
                                  <a href="#"></a>
                            </figure>
                        </div>
                    </article>
                </article>
        </section> 
    </main>

<script>
var connexion = document.querySelectorAll('.fenetre-connexionpro');
var input = document.querySelectorAll('.text');
var bouton = document.querySelectorAll('.connexion-pro');


connexion[0].addEventListener('mouseenter' , colorModify_1);
connexion[0].addEventListener('mouseleave' , colorModify_2);
input[0].addEventListener('mouseenter' , colorModify_2);
input[0].addEventListener('mouseleave' , colorModify_1);
input[1].addEventListener('mouseenter' , colorModify_2);
input[1].addEventListener('mouseleave' , colorModify_1);
bouton[0].addEventListener('click' , colorModify_3);


function colorModify_1() {
    event.target.style.backgroundColor = "white";
    event.target.style.color = "black";
}
function colorModify_2() {
    event.target.style.backgroundColor = "lightgray";
    event.target.style.color = "green";
}
function colorModify_3() {
    event.target.style.backgroundColor = "orange";
    event.target.style.color = "black";
}

</script>
<?php
include ("footer.php")
?>