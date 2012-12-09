<?php
/*
 *      include/menu.php
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
session_start();
include('config.php');
?>
<div id="menu">
	<div class="element_menu">
		<h3 class="menu_img" >Général</h3>
		<ul>
			<li><a class="lien_menu" href="/" title="Page d'accueil de M.Y.N."> Accueil</a></li>
			<li><a class="lien_menu" href="/config/hotes.php" title="Les hôtes"> Hôtes</a></li>
			<li><a class="lien_menu" href="/config/services.php" title="Les services"> Services</a></li>
			<li><a class="lien_menu" href="/config/autres.php" title="À venir"> Autres</a></li>
			<?php
				if(isset($_SESSION['mbrid']) && ($_SESSION['mbrid'] != ''))
				{
			?>
					<li><a class="lien_menu" href="/config/admin.php" title="Configuration"> Administration</a></li>
			<?php
				}
			?>
			<li><a class="lien_menu" href="/myn_ntop.php" title=" ntop"> NTOP</a></li>
		</ul>

		<h3 class="menu_img" >Infos</h3>
		<ul>
		<?php
			if($_SESSION['niveau'] == "adminsite")
			{
				echo '<li><a class="lien_menu" href="/rss.php" title="Flux RSS"> Update RSS</a></li>';
			}
		?>
			<li><a class="lien_menu" href="/credits.php" title="Crédits et licences"> Crédits</a></li>
			<li><a class="lien_menu" href="/rss.xml" title="Flux RSS"> RSS <sub><img alt="rss" src="/imgs/puces/rss-02.png" title="S'abonner à ce flux" /></sub></a></li>
			<!--form target="_top" method="get" action="http://www.ethicle.com/fr/search.php">
				<li><br /><br /><a href="http://www.ethicle.com/fr/"> <img border="0" src="/imgs/images/logo-mini.png" title="Un arbre planté toutes les 100 recherches"/></a><br /><br /></li>
				<li>
					<input type="text" value=""  maxlength="250" size="16" name="q"/>
					<input type="hidden" value="1d" maxlength="250" size="40" name="time"/>
					<input type="hidden" value="web" maxlength="250" size="40" name="type"/>
				</li>
				<li>
					<input type="submit" value="Rechercher" name="sa"/>
				</li>
			</form-->
								<!--iframe
									src="http://www.ethicle.com/search.php?q=[Your search]&frame=1"
									width=600
									height=400
									scrolling=auto
									frameborder=0 >
								</frame-->
			<!-- <li><a class="lien_menu_w3c"></a><br /><br /><br /><br />
				<a href="http://validator.w3.org/check?uri=referer">
				<img src="/imgs/images/valid-xhtml10"
				alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
			</li>
			<li><a class="lien_menu_w3c"></a><br />
			    <a href="http://jigsaw.w3.org/css-validator/check/referer">
		        <img style="border:0;width:88px;height:31px"
	            src="/imgs/images/vcss"
	            alt="CSS Valide !" /></a>
			</li> -->
		</ul>
	</div>
</div>
