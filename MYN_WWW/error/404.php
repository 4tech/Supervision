<?php
/*
 *	404.php - Affiche un message en cas d'erreur 404 - Pour l'instant sert aux pages non créées
 *
 *      2012, Tdey <devs@tdey.org>
 */
session_start();
include('config.php');
/* ------ Actualisation de la session... ------ */
$titre = '404';
session_start();
include('config.php');
include('fonctions.php');
db_connect();
actualiser_session();
/* ------ Fin actualisation de session... ------ */
include("entete.php");
include("menu.php");
?>
<div class="corpsadmin">
	<?php
		include('menu_h.php');
	?>
</div>
<br />
<div class="corps1">
	<br /><br /><br /><br />
	<div class="center">
	<?php
		echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 404 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
	?>
		<a>Cette page/fonctionnalité n'éxiste pas ou n'est pas encore disponible, merci de votre compréhension.</a>
		<br /><br /><br />
		<a class="liens" href="/index.php">Retour à l'accueil</a>
	</div>
</div>
