<?php
/*
 *	stats/nb_membres.php
 *
 *      2012, Tdey <devs@tdey.org>
 */
/* ------ En-tête et titre de page ------ */
$titre = 'Liste des membres du site';
include('entete.php'); //contient le doctype, et head.
/* ------ Fin en-tête et titre ------ */
include('menu.php');
?>
<div id="contenu">
	<div id="map">
		<a class="liens" href="index.php">Accueil</a> => <a href="stats.php?see=nb_membres">Liste des utilisateurs</a>
	</div>
<?php
	$membre_query = sqlquery("SELECT mbrid, pseudo, date_inscript
	FROM membresok
	ORDER BY mbrid ASC", 2) or die ("Erreur SQL : ".mysql_error());
	$i = 0;
?>
	<div> <!--</div> class="membre_liste"-->
		<table>
			<thead>
				<th>N° d'utilisateur</th>
				<th>Pseudonyme</th>
				<th>Date d'autorisation</th>
			</thead>
			<tfoot>
				<th>N° d'utilisateur</th>
				<th>Pseudonyme</th>
				<th>Date d'autorisation</th>
			</tfoot>
			<tbody>
		<?php
				while(isset($membre_query[$i]))
				{
					echo '<tr class="ligne_'.($i%2).'">
					<td>'.$membre_query[$i]['mbrid'].'</td>
					<td><a href="membres/user.php?id='.$membre_query[$i]['mbrid'].'">'.htmlspecialchars($membre_query[$i]['pseudo'], ENT_QUOTES).'</a></td>
					<td>'.mepd($membre_query[$i]['date_inscript']).'</td>
					</tr>
					';
					$i++;
				}
				if($i == 0) echo '<tr><td colspan="3">Pas d'utilisateur trouvé.</td></tr>';
		?>
			</tbody>
		</table>
	</div>
</div>
