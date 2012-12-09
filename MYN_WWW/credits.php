<?php
/*
 *      /credits.php - Crédits & Licences
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
$titre = 'Crédits';
session_start();
include('config.php');
/* ------ Actualisation de la session... ------ */
include('fonctions.php');
db_connect();
actualiser_session();
/* ------ Fin actualisation de session... ------ */
include("entete.php");
include("menu.php");
?>
<div class="corpsadmin">
	<?php
//		include('menu_h.php');
	?>
</div>
<br />
<div class="corps1">
	<br />
	<h1 class="center">INFOS</h1><br />
	<fieldset><legend>Infos</legend>
		<br /><a class="auteur3"> Version de M.I.N. : </a><a>0.1.3b</a>
		<br /><br /><a class="auteur3"> Licence de M.Y.N. : </a><a>GPL v.2</a>
		<br /><a class="auteur3"> Licence des médias : </a>
		<a class="liens" rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/80x15.png" /></a><a> sauf mention contraire</a>
		<br /><a class="auteur3"> -</a>Cette application et ses médias sont sous licence  <a class="liens" rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution 3.0 Unported License</a>.
		<br /><br /><a class="auteur3"> Thème d'icône </a><a class="liens" href="http://LaGaDesk.deviantart.com/art/LaGaDesk-BlackWhite-III-1-5-0-144847996">LaGaDesk-BlackWhite-III</a>
		<br /><br />
	</fieldset>
	<br />
</div>
