<?php
include ("header.php")
?>
    <main class="main-particuliers">
        <section class="section-signalements">
            <h1 class="section-title">Suivi des signalements</h1>
            <div>
                <article></article>
                <article></article>
            </div>
            <h1 class="section-title">Nouveau signalements</h1>
            <div class="nouv-signalement">
                <!-- Quand on fera le JavaScript, on affichera un popup correspondant au type de signalement choisi par d'utilisateur -->
                <div class="signalements-3">
                    <div class="signal-type">
                        <img src="https://img.icons8.com/fluency/48/null/trash-pile.png"/>
                        <p>Déchet</p>
                    </div>
                    <div class="signal-type">
                        <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/48/null/external-battery-ecology-flaticons-flat-flat-icons-2.png"/>
                        <p>Batterie</p>
                    </div>
                    <div class="signal-type">
                        <img src="https://img.icons8.com/fluency/48/null/appliances.png"/>
                        <p>Électroménager</p>
                    </div>
                </div>
                <div class="signalements-6">
                    <div class="signal-type">
                        <img src="https://img.icons8.com/fluency/48/null/sofa.png"/>
                        <p>Mobilier</p>
                    </div>
                    <div class="signal-type">
                        <img src="https://img.icons8.com/fluency/48/null/tire.png"/>
                        <p>Pneus</p>
                    </div>
                    <div class="signal-type">
                        <img src="https://img.icons8.com/fluency/48/null/laptop-alert.png"/>
                        <p>Électronique</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="map-iframe">
            <iframe src="https://www.google.com/maps/d/embed?mid=1Ia9SO8NDsrlIgmurMG5flbi2C5pK9NU&ehbc=2E312F" width="600" height="450"></iframe>
        </section>
        <section>
            <!-- Eléments de la carte -->
        </section>
    </main>
<?php
include ("footer.php")
?>