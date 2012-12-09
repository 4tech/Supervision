<?php
	header ("Content-type: image/png; charset: UTF-8");
	$image = imagecreate(500,50);

	if (date("H") > 8 AND date("H") < 20) // Il fait jour
	{
	    $fond = imagecolorallocate($image, 255, 255, 255); // Fond bleu clair
	    $couleur_texte = imagecolorallocate($image, 0, 0, 0); // Texte en vert
	    $texte = 'Bonjour, ';
	}
	else // Il fait nuit
	{
	    $fond = imagecolorallocate($image, 0, 0, 0); // Fond noir
	    $couleur_texte = imagecolorallocate($image, 255, 255, 255); // Texte en blanc
	    $texte = 'Ca va etre tout noir, ';
	}

	$heure = $texte . 'il est ' . date('H\h i'); // On stocke l'heure et les minutes dans une variable

	imagestring($image, 5, 40, 15, $heure, $couleur_texte); // On affiche l'heure dans la bonne couleur

	imagepng($image);
?>
<!--?php
	header ("Content-type: image/png");
	$image = imagecreate(200,50);

	$orange = imagecolorallocate($image, 255, 128, 0);
	$bleu = imagecolorallocate($image, 0, 0, 255);
	$bleuclair = imagecolorallocate($image, 156, 227, 254);
	$noir = imagecolorallocate($image, 0, 0, 0);
	$blanc = imagecolorallocate($image, 255, 255, 255);

	imagestring($image, 4, 35, 15, "Salut les Zér0s !", $blanc);

	imagepng($image);
?>
