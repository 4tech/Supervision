<?php
/*
 *      services.php - recueil des services monitorés
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
$titre = 'Les Services';
session_start();
include('config.php');
/* ------ Actualisation de la session... ------ */
include('fonctions.php');
db_connect();
actualiser_session();
/* ------ Fin actualisation de session... ------ */
	include("entete.php");
	include("menu.php");
//	include("corpsb.php");
?>
