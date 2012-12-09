<?php
/*
 *      hotes.php - Recueil des hôtes monitorés
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
$titre = 'Les Hôtes';
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
