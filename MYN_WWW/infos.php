<?php
/*
 *	infos.php - Gère les informations (page incluse).
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
if(!isset($informations))
{
	$informations = Array(
			true,
			'Erreur',
			'Une erreur interne est survenue...',
			'',
			'/index.php',
			3
			);
}
if($informations[0] === true) $type = 'Erreur';
else $type = 'Information';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<title><?php echo $informations[1]; ?> : <?php echo TITRESITE; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="language" content="fr" />
		<meta http-equiv="Refresh" content="<?php echo $informations[5]; ?>;url=<?php echo $informations[4]; ?>" />
		<link rel="stylesheet" title="Design" href="/design.css" type="text/css" media="screen" />
	</head>
	<body>
		<div id="info">
			<div id="<?php echo $type; ?>"><?php echo $informations[2]; ?><br/> Redirection en cours...<br/>
			<a class="liens" href="<?php echo $informations[4]; ?>">Cliquez ici si vous ne voulez pas attendre...</a><br /><?php echo $informations[3]; ?></div>
		</div>
	</body>
</html>
<?php
unset($informations);
