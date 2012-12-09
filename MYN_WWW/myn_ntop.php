<?php
/*
 *      index.php - page d'accueil
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
$titre = 'Accueil';
session_start();
include('config.php');
/* ------ Actualisation de la session... ------ */
include('fonctions.php');
db_connect();
actualiser_session();
/* ------ Fin actualisation de session... ------ */
	include("entete.php");
	include("menu.php");
//	include("myn_corps.php");
?>
<br/>
<br/>
<div class="corps1">
	<iframe src="http://localhost:3000" width="100%" height="1000" name="ntopFrame" id="ntopFrame"></iframe>
</div>
