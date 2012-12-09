<?php
/*
 *      include/entete.php - Page incluse créant le doctype etc etc.
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<?php
	/* ------- Vérification du titre... ------- */
			if(isset($titre) && trim($titre) != '')
			$titre = TITRESITE.' : '.$titre;
			else
			$titre = TITRESITE;
	/* ------- Fin vérification titre... ------- */
		?>
			<title><?php echo $titre; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="language" content="fr" />
			<link rel="icon" href="/favicon.png" type="image/png" />
			<link rel="stylesheet" title="Design" href="/css/01a.css" type="text/css" media="screen" />
			<link rel="alternate" type="application/rss+xml" title="RSS_2.0" href="/rss.xml" />
	</head>
	<div id="entete">
		<a href="/index.php" title="Retour à l'accueil"><img src="/imgs/images/myn_logo.png"/></a>
		<div class="login">
			<?php
				if(isset($_SESSION['mbrid']))
				{
			?>
					<a id="pseud"><?php echo $_SESSION['pseudo']; ?></a> : <a class="liens" href="/membres/user.php?id=<?php echo $_SESSION['mbrid']; ?>" title="Modifier mon profil">Gérer mon compte</a> - <a class="liens" href="/membres/deconnexion.php" title="Déconnexion">Me déconnecter</a>
			<?php
				}
				else
				{
			?>
					<a class="liens" href="/membres/connexion.php" title="Connexion">Me connecter</a>
			<?php
				}
			?>
		</div>
	</div>
