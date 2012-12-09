<?php
/*
 *      include/menu_h.php
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
session_start();
include('config.php');
?>
<div class="menu_horizontal">
	<ul id="menu_h">
		<li class="depart">
		</li>
		<li>
			<a href="#" title="Menu Principal"><h3><sub><img src="/imgs/puces/admin/accueil.png" alt="Général" /></sub><sup>Général</sup></h3></a>
			<ul class="smenu_h">
				<li class="bouton_gauche"><a href="/" title="Accueil du site"> Accueil</a></li>
				<li><a class="bouton_gauche" href="/projets/liste.php" title="Les projets en cours"> Les projets</a></li>
				<li class="bouton_gauche"><a href="/pages/news.php" title="Nouvelles générales"> News</a></li>
				<li class="bouton_gauche"><a href="/pages/annonces.php" title="Annonces générales"> Annonces</a></li>
				<?php
					if(isset($_SESSION['mbrid']) && ($_SESSION['mbrid'] != ''))
					{
				?>
						<li class="bouton_gauche"><a class="lien_menuh" href="/pages/nouv_art.php" title="Ecrire un nouvel article"> Rédiger</a></li>
				<?php
					}
				?>
				<li class="bouton_gauche"><a class="lien_menuh" href="/wiki/" target="_blank" title="Le Wiki"> Le Wiki</a></li>
				<li class="bouton_gauche"><a class="lien_menuh" href="/pages/liens.php?lienx=web" title="Liens externes"> Liens</a></li>
				<li class="bouton_gauche"><a class="lien_menuh" href="/pages/evenements.php" title="Evènements et festivals"> Évènements</a></li>
			</ul>
		</li>
		<?php
			if(isset($_SESSION['projet'][0]))
			{
				$projid = $_SESSION['projet'][0];
		?>
				<li>
					<a href="#" title='Menu du projet "<?php echo $_SESSION['projet'][0]; ?>"'><h3><sub><img src="/imgs/puces/admin/projets.png" alt="Le Projet" /></sub><sup>Projet</sup></h3></a>
					<ul class="smenu_h">
						<li class="bouton_gauche"><a href="/projets/index.php?projet=<?php echo $_SESSION['projet'][0]; ?>" title='Accueil du projet "<?php echo $_SESSION['projet'][0]; ?>"'> Accueil</a></li>
						<li class="bouton_gauche"><a href="/projets/news.php" title="Nouvelles du projet"> News</a></li>
						<li class="bouton_gauche"><a href="/projets/annonces.php" title="Petites annonces du projet"> Annonces</a></li>
						<li class="bouton_gauche"><a href="/404.php" title="Avancement du projet"> Avancement</a></li><!-- "/pages/pjt_avance.php" -->
						<?php
							if($_SESSION['niveau'] == "adminsite")
							{
						?>
								<li class="bouton_gauche"><a href="/admin/admin.php?zone=accueil" title="Administration du site"> Admin site</a></li>
								<li class="bouton_gauche"><a href="/rss.php" title="Flux RSS"> Update RSS</a></li>
						<?php
							}
							else
							{
								if($_SESSION['auth'] == 'ok')
								{
						?>
									<li class="bouton_gauche"><a href="/admin/admin_projet.php?zone=accueil&projet=<?php echo $_SESSION['projet'][0]; ?>" title='Administration du projet "<?php echo $_SESSION['projet'][0]; ?>"'> Admin projet</a></li>
						<?php
								}
								else
								{
								}
							}
						?>
					</ul>
				</li>
				<li>
					<a href="#" title="<?php echo $_SESSION['projet'][0]; ?>"><h3><sub><img src="/imgs/puces/admin/user-home.png" alt="<?php echo $_SESSION['projet'][0]; ?>" /></sub><sup>Mes projets</sup></h3></a>
					<ul class="smenu_h">
					<?php
						$pilou = array();
						$pilou = $_SESSION['projet'];
						unset($pilou[0]);
						foreach($pilou AS $xppal)
						{
					?>
							<li class="bouton_gauche"><a href="/projets/index.php?projet=<?php echo $xppal; ?>&nv=1" title='Aller au projet"<?php echo $xppal; ?>"'> <?php echo $xppal; ?></a></li>
					<?php
						}
						?>
					</ul>
				</li>
		<?php
			}
			else
			{
			}
		?>
		<?php
			if(isset($_SESSION['mbrid']) && ($_SESSION['mbrid'] != ''))
			{
		?>
				<li>
					<a href="#" title="Menu Personnel"><h3><sub><img src="/imgs/puces/admin/membres.png" alt="Perso" /></sub><sup>Perso</sup></h3></a>
					<ul class="smenu_h">
						<li class="bouton_gauche"><a href="/upload/upload_user.php?up=none" title="Mes médias"> Mes médias</a></li>
						<?php
							if($_SESSION['niveau'] == "adminsite")
							{
						?>
								<li class="bouton_gauche"><a href="/include/nouv_news.php" title="Nouelle news"> Nelle news</a></li>
						<?php
							}
							else
							{
								if($_SESSION['niveau'] == "adminprojet")
								{
						?>
									<li class="bouton_gauche"><a href="/include/nouv_news.php" title='Nouvelle news sur le projet "<?php echo $_SESSION['projet'][0]; ?>"'> Nelle news</a></li>
						<?php
								}
								else
								{
								}
							}
						?>
						<li class="bouton_gauche"><a href="/include/nouv_annonce.php" title='Nouvelle annonce sur le projet "<?php echo $_SESSION['projet'][0]; ?>"'> Nelle annonce</a></li>
						<li class="bouton_gauche"><a href="/404.php" title="Messagerie"> Messagerie</a></li><!-- "/pages/prs_messagerie.php" -->
						<li class="bouton_gauche"><a href="/membres/user.php?id=<?php echo $_SESSION['mbrid']; ?>" title="Préférences utilisateur"> Préférences</a></li>
						<li class="bouton_gauche"><a href="/pages/nouv_pjt.php" title="Nouveau projet"> Créer un projet</a></li>
					</ul>
				</li>
		<?php
			}
			else
			{
			}
			if(isset($_GET['projet']) AND ($_GET['projet'] != '') AND isset($_SESSION['mbrid']) && ($_SESSION['mbrid'] != ''))
			{
				//if pas membre de ce projet juste pour tester là
				if((isset($_SESSION['projet'][0]) AND (!in_array($_GET['projet'], $_SESSION['projet']))) OR ($_SESSION['projet'][0] == ''))
				{
		?>
				<li class="bouton_droit2">
					<a href="/projets/index.php?projet=<?php echo $_GET['projet']; ?>&part=1" title="Ne pas cliquer - Participer au projet - Pas encore actif"><h3><sub><sub><img src="/imgs/puces/admin/puce_add.png" alt="Perso" /></sub></sub><sub> Participer</sub></h3></a>
				</li>
		<?php
				}
				//else, pareil, pour test
				else if(isset($_SESSION['projet'][0]) AND (in_array($_GET['projet'], $_SESSION['projet'])))
				{
		?>
				<li class="bouton_droit2">
					<a href="/projets/index.php?projet=<?php echo $_GET['projet']; ?>&part=0" title="Ne pas cliquer - Ne plus participer - Pas encore actif"><h3><sub><img src="/imgs/puces/admin/puce_remove.png" alt="Perso" /></sub><sub> Se retirer</sub></h3></a>

				</li>
		<?php
				}
			}
		?>
	</ul>
</div>
