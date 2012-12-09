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
	include("myn_corps.php");
?>
