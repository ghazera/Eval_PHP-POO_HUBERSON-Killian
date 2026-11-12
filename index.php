<?php
// on charge nos variables d'environnement
require_once('env.php');

// on charge notre function pour trim nos données (sanitize)
require_once('utils/utils.php');

// on charge nos class des deux view
require_once('View/View.php');
require_once('View/ViewHome.php');

// on charge nos modeles
require_once('Model/Model.php');
require_once('Model/ModelPlayer.php');

// on charge nos controllers
require_once('Controller/Controller.php');
require_once('Controller/ControllerHome.php');

//on créer notre controller en instancant notre model & view
$controller = new ControllerHome(
    new ModelPlayer(),
    new ViewHome()
);

// on traite nos données du formulaire
$controller->registerPlayer();

// on récupere tt nos joueurs
$controller->displayPlayers();

// on fait le rendu de notre page HTMLL
$controller->render();
?>
