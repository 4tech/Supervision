<?php
/*
 *	stats/index.php - Index des statistiques du site.
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
/* ------ En-tête et titre de page ------ */
$titre = 'Statistiques du site';
include('entete.php'); //contient le doctype, et head.
/* ------ Fin en-tête et titre ------ */
include('menu.php');
?>
<div class="corpsadmin">
	<?php
		include('menu_h.php')
	?>
</div>
<div class="corps1">
	<div id="contenu">
		<div id="map">
			<a class="liens" href="index.php">Accueil</a> => <a href="stats.php">Statistiques</a>
		</div>
		<br /><br />
		<h1>Statistiques</h1>
		Bienvenue sur la page des statistiques du site.<br/>
		Ici, vous pourrez voir les statistiques concernant les utilisateurs, les périphériques, le système, etc., etc. :)<br/>
		<br /><br />
		<h2>Utilisateurs</h2>
		<div>
			=> Les liens ne fonctionnent pas pour le moment, je fais l'espace users avant...
			<br />
			-> <a class="liens" href="stats.php?see=nb_membres">Il y a <?php echo $num1; if($num1 <= 1) echo ' membre inscrit'; else echo ' utilisateurs admins'; ?>.</a><br/>
			-> <a class="liens" href="stats.php?see=connectes">Il y a <?php echo $num2; if($num2 <= 1) echo ' visiteur'; else echo ' utilisateurs sans privilèges' ?>.</a><br/>
			-> <a class="liens" href="stats.php?see=passed">Voir les dernières visites de chaque utilisateur.</a><br/>
		</div>
	</div>
</div>
