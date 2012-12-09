<?php
/*
 *	error/erreur.php - Gestion et affichage des codes d'erreurs
 *
 *      2012, Tdey <devs@tdey.org>
 */
session_start();
include('config.php');
/* ------ Actualisation de la session... ------ */
$titre = '403';
session_start();
include('config.php');
include('fonctions.php');
db_connect();
actualiser_session();
/* ------ Fin actualisation de session... ------ */
include("entete.php");
include("menu.php");
?>
<div class="corpsadmin">
	<?php
		include('menu_h.php');
	?>
</div>
<br />
<div class="corps1">
	<br /><br /><br /><br />
	<div class="center">
		<?php
			switch($_GET['erreur']) {
				case '100':
					echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 101 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
					echo '<a>Le serveur a changé de protocoles.</a>';
				break;
                                case '101':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 101 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Le serveur a changé de protocoles.</a>';
                                break;
                                case '200':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 200 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Requête effectuée avec succès.</a>';
                                break;
                                case '201':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 201 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Document créé (raison : nouvelle URI).</a>';
                                break;
                                case '202':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 202 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Requête achevée de manière asynchrone (TBS).</a>';
                                break;
                                case '203':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 203 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Requête achevée de manière incomplète.</a>';
                                break;
                                case '204':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 204 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Aucune information à renvoyer.</a>';
                                break;
                                case '205':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 205 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Requête terminée mais formulaire vide.</a>';
                                break;
                                case '206':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 206 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Requête GET incomplète.</a>';
                                break;
                                case '300':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 300 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Le serveur ne peut pas déterminer le code de retour.</a>';
                                break;
                                case '301':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 301 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Document déplacé de façon permanente.</a>';
                                break;
                                case '302':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 302 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Document déplacé de façon temporaire.</a>';
                                break;
                                case '303':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 303 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Redirection avec nouvelle méthode d'accès.</a>";
                                break;
                                case '304':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 304 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Le champ 'if-modified-since' n'était pas modifié.</a>";
                                break;
                                case '305':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 305 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Redirection vers un proxy spécifié par l'entête.</a>";
                                break;
                                case '306':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 306 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>...</a>';
                                break;
                                case '307':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 307 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>HTTP/1.1.</a>';
                                break;
                                case '400':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 400 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Erreur de syntaxe dans l'adresse du document.</a>";
                                break;
                                case '401':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 401 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Pas d'autorisation d'accès au document.</a>";
                                break;
                                case '402':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 402 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Accès au document soumis au paiement.</a>';
                                break;
                                case '403':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 403 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Pas d'autorisation d'accès au serveur.</a>";
                                break;
                                case '404':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 404 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>La page demandée n'existe pas.</a>";
                                break;
                                case '405':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 405 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Méthode de requête du formulaire non autorisée.</a>';
                                break;
                                case '406':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 406 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Requête non acceptée par le serveur.</a>';
                                break;
                                case '407':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 407 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Autorisation du proxy nécessaire.</a>';
                                break;
                                case '408':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 408 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Temps d'accès à la page demandée expiré.</a>";
                                break;
                                case '409':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 409 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>L'utilisateur doit soumettre à nouveau avec plus d'infos.</a>";
                                break;
                                case '410':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 410 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Cette ressource n'est plus disponible.</a>";
                                break;
                                case '411':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 411 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Le serveur a refusé la requête; elle n'a pas de longueur.</a>";
                                break;
                                case '412':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 412 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>La précondition donnée dans la requête a échoué.</a>';
                                break;
                                case '413':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 413 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>L'entité de la requête est trop grande.</a>";
                                break;
                                case '414':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 414 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>L'URI de la requête est trop longue.</a>";
                                break;
                                case '415':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 415 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Type de média non géré.</a>';
                                break;
                                case '500':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 500 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Erreur interne au serveur.</a>';
                                break;
                                case '501':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 501 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Le serveur ne supporte pas le service demandé ou la requête faite au serveur n'a pas été supprimée.</a>";
                                break;
                                case '502':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 502 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Mauvaise passerelle d'accès.</a>";
                                break;
                                case '503':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 503 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Service indisponible.</a>';
                                break;
                                case '504':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 504 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo "<a>Temps d'accès à la passerelle expiré.</a>";
				break;
				case '505':
                                        echo '<div class="center"><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a><a style="font-size:2em; font-weight:bold; color:black"> 505 </a><a style="font-size:8em; font-weight:bold; color:red">&#x2620;</a></div>';
                                        echo '<a>Version http non gérée.</a>';
                                break;
			}
		?>
			<br /><br /><br />
			<a class="liens" href="/index.php">Retour à l'accueil</a>
	</div>
</div>
