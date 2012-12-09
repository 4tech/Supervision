<?php
/*
 *	stats.php - Quelques simples statistiques concernant le site, les membres et visiteurs.
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
session_start();
header('Content-type: text/html; charset=utf-8');
include('config.php');
/* ------ Actualisation de la session... ------ */
include('fonctions.php');
db_connect();
actualiser_session();
/* ------ Fin actualisation de session... ------ */
?>
<?php
	if($_GET['see'] == '' || !isset($_GET['see']))
	{
		include('index.php');
	}
	else
	{
		if(strpos($_GET['see'], '.') !== FALSE || strpos($_GET['see'], ':') !== FALSE || strpos($_GET['see'], 'http') !== FALSE) //$_GET['see'] contient des caractères invalides (tentative de hack ?)
		{
			include('index.php');
		}
		else if(file_exists($_GET['see'].'.php'))
		{
			include($_GET['see'].'.php');
		}
		else
		{
			include('index.php');
		}
	}
	mysql_close();
?>
