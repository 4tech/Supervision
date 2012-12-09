<?php
/*
 *	stats/passed.php - Affiche une liste complète des dates de visite des membres.
 *
 *      2012, Tdey <devs@tdey.org>
 */
/* ------ En-tête et titre de page ------*/
$titre = 'Liste des dernières visites';
include('entete.php'); //contient le doctype, et head.
/* ------ Fin en-tête et titre ------ */
include('menu.php');
?>
<div id="contenu">
	<div id="map">
		<a class="liens" href="index.php">Accueil</a> => <a href="stats.php?see=passed">Liste des visites</a>
	</div>
	<h1>Liste des visites</h1>
<?php
	$membre_query = sqlquery("SELECT mbrid, pseudo, dernvisit, connectes_id
	FROM membresok
	LEFT JOIN connectes
	ON mbrid = connectes_id
	ORDER BY dernvisit DESC", 2) or die ("Erreur SQL : ".mysql_error());
	$i = 0;
?>
	<div class="membre_liste">
		<table>
			<thead>
				<th>N° d'utilisateur</th>
				<th>Pseudonyme</th>
				<th>Dernière connexion</th>
				<th>Statut</th>
			</thead>
			<tfoot>
				<th>N° d'utilisateur</th>
				<th>Pseudonyme</th>
				<th>Dernière connexion</th>
				<th>Statut</th>
			</tfoot>
			<tbody>
		<?php
				while(isset($membre_query[$i]))
				{
					if($membre_query[$i]['connectes_id'] == $membre_query[$i]['mbrid']) //gestion des statuts de connexion
					{
						$statut = '<span class="actif">Connecté</span>';
					}
					else
					{
						$statut = '<span class="inactif">Déconnecté</span>';
					}
					echo '<tr class="ligne_'.($i%2).'">
					<td>'.$membre_query[$i]['mbrid'].'</td>
					<td><a href="membres/user.php?id='.$membre_query[$i]['mbrid'].'">'.htmlspecialchars($membre_query[$i]['pseudo'], ENT_QUOTES).'</a></td>
					<td>'.mepd($membre_query[$i]['dernvisit']).'</td>
					<td>'.$statut.'</td>
					</tr>
					';
					$i++;
				}
				if($i == 0) echo '<tr><td colspan="4">Pas d'utilisateur trouvé.</td></tr>';
		?>
			</tbody>
		</table>
	</div>
</div>
