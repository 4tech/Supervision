<?php session_start();
/*
 *      include/verif_pseudo.php
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */

if(!isset($_SESSION['pseudo']))
{
	include("../include/entete.php");
	include("../include/menu.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
	<title>nouveau commentaire</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" media="screen" type="text/css" title="css_01-alt" href="../css/01a.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="css_01-altbis" href="../css/01b.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="css_01" href="../css/01.css" />
	<link rel="icon" href="favicon.gif" type="image/gif" />
	<meta name="generator" content="Geany 0.18" />
</head>
<body>
	<div class="corps1">
		<div class="article">
			<br /><br />
			<h1>Vous n'êtes pas connecté. Vous n'avez pas l'autorisation d'accéder à cette page.</h1><br />
		</div>
		<br />
		<a href="../index.php">Retour à l'accueil</a>
	</div>
<?php
	exit;
}
?>
<!--?php
include("./verif_pseudo.php");	// code à inclure dans les pages à "protèger"
?>
</body>
</html>
__>
