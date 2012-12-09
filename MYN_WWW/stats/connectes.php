<?php
/*
 *	stats/connectes.php - Affiche une liste complète des membres connectes.
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
/* ------ En-tête et titre de page ------ */
$titre = 'Liste des connectés';
include('entete.php'); //contient le doctype, et head.
/* ------ Fin en-tête et titre ------ */
include('menu.php');
?>
<div id="contenu">
	<div id="map">
		<a class="liens" href="/index.php">Accueil</a> => <a href="/stats.php?see=connectes&a=<?php echo intval($_GET['a']); ?>">Liste des connectés</a>
	</div>
	<h1>Liste des connectés</h1>
<?php
	if($_GET['a'] == 1)
	{
		$id = '';
	}
	else if($_GET['a'] == 2)
	{
		$id = ' AND connectes_id = -1';
	}
	else
	{
		$id = ' AND connectes_id <> -1';
	}
	$membre_query = sqlquery("SELECT mbrid, pseudo, connectes_actualisation
	FROM connectes
	LEFT JOIN membresok ON mbrid = connectes_id
	WHERE connectes_actualisation > ".(time()-1800).$id."
	ORDER BY connectes_actualisation DESC", 2) or die ("Erreur SQL : ".mysql_error());
?>
	<!--menu//-->
	<div class="center">
		<?php
			if($_GET['a'] == 1 || $_GET['a'] == 2)
			{
				echo '<a class="liens" href="stats.php?see=connectes">Voir seulement les membres connectés</a>';
				$avt = 1;
			}
			if($_GET['a'] != 2)
			{
				if($avt == 1) echo ' - ';
				echo '<a class="liens" href="stats.php?see=connectes&a=2">Voir seulement les invités connectés</a>';
				$avt = 1;
			}
			if($_GET['a'] != 1)
			{
				if($avt == 1) echo ' - ';
				echo '<a class="liens" href="stats.php?see=connectes&a=1">Voir les membres et les invités connectés</a>';
			}
		?>
	</div>
	<!--tableau//-->
	<table>
		<thead>
			<th>N° du membre</th>
			<th>Pseudonyme</th>
			<th>Dernière connexion</th>
		</thead>
		<tfoot>
			<th>N° du membre</th>
			<th>Pseudonyme</th>
			<th>Dernière connexion</th>
		</tfoot>
		<tbody>
			<?php
				$i = 0;
				while(isset($membre_query[$i]))
				{
					if($membre_query[$i]['mbrid'] != '')
					{
						$lien = '<a href="membres/user.php?id='.$membre_query[$i]['mbrid'].'">';
						$lien2 = '</a>';
					}
					else
					{
						$lien = '';
						$lien2 = '';
					}
					if($membre_query[$i]['mbrid'] == '') //un invité n'a pas de lien, ni d'id.
					{
						$membre_query[$i]['mbrid'] = 'Non renseigné'; //
						$membre_query[$i]['pseudo'] = 'Invité';
					}
					echo '<tr class="ligne_'.($i%2).'">
					<td>'.$membre_query[$i]['mbrid'].'</td>
					<td>'.$lien.htmlspecialchars($membre_query[$i]['pseudo'], ENT_QUOTES).$lien2.'</td>
					<td>'.mepd($membre_query[$i]['connectes_actualisation']).'</td>
					</tr>
					';
					$i++;
				}
				if($i == 0) echo '<tr><td colspan="3">Pas de membre trouvé.</td></tr>';
			?>
		</tbody>
	</table>
</div>
