<?php
/*
 * index.php
 *
 * 2010, Tdey - Akmes <devs - "le petit a dans le rond" - tdey - "pas la virgule" - org> Page d'accueil
 */
$titre = 'Accueil';
session_start();
include('config.php');
/* ------ Actualisation de la session... ------ */
include('fonctions.php');
db_connect();
actualiser_session();
pagination($url,$parpage,$nblignes,$nbpages);
/* ------ Fin actualisation de session... ------ */
        include("entete.php");
        include("menu.php");
?>
<div class="corps1">
	<?php
		include('barre_etats.php');
	?>
<?php
	echo '<span style="font-size: 3em;"><B>Tdey Horror Show</B></span><br />';
	echo 'Logs et Statuts des services sur le serveur :<br /><br />';

	switch($_GET['zone'])
	{
		case '':
		case 'services':

			$googlecome = shell_exec('cat /var/www/PROJET/google-proven.txt');
                        echo "<li><B>GOOGLE SEARCH : <span style='color: green;'>Actif</span></B></li><span style='color: default;'>$googlecome</span><hr><br />";

		        $uptime = shell_exec('uptime');
		        echo "<li><B>UPTIME : <span style='color: blue;'>$uptime</span></B></li><hr><br />";

			$processes = shell_exec('ps -e');

		### Serveur fichiers dynamique -> Apache2 ###
			if (!preg_match('`apache2`', $processes)) {
				echo '<li><B>APACHE : <span style="color: red;">Eteint</span></B></li>';
			}
			else {
				echo '<li><B>APACHE : <span style="color: green;">Actif</span></B></li>';
			}
			$data = array();
			exec('ps ax | grep apache2 | grep -v "grep"', $data, $ret);
			if ($ret == 0) {
				foreach ($data as $line) {
			        	echo "$line<br />";
			    	}
			}
			else {
			    echo "...";
			}
			echo '<hr><br />';

		### Serveur fichiers statiques (en frontal) -> NginX ###
        		if (!preg_match('`nginx`', $processes)) {
        		        echo '<li><B>NGINX : <span style="color: red;">Eteint</span></B></li>';
        		}
        		else {
        		        echo '<li><B>NGINX : <span style="color: green;">Actif</span></B></li>';
        		}
        		$data = array();
        		exec('ps ax | grep nginx | grep -v "grep"', $data, $ret);
        		if ($ret == 0) {
        		        foreach ($data as $line) {
        		                echo "$line<br />";
        		        }
        		}
        		else {
        		    echo "...";
			 }
			echo '<hr><br />';

		### Php/Fast-cgi -> spawn-fastcgi / php5-fcgi ###
		        if (!preg_match('`php5-cgi`', $processes)) {
		                echo '<li><B>SPAWN-FCGI : <span style="color: red;">Eteint</span></B></li>';
		        }
		        else {
		                echo '<li><B>SPAWN-FCGI : <span style="color: green;">Actif</span></B></li>';
		        }
		        $data = array();
		        exec('ps ax | grep php5-cgi | grep -v "grep"', $data, $ret);
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br />";
		                }
		        }
		        else {
		            echo "...";
		        }
		        echo '<hr><br />';

		### SQL -> MySQL ###
			if (!preg_match('`mysqld`', $processes)) {
				echo '<li><B>MYSQL : <span style="color: red;">Eteint</span></B></li>';
			}
			else {
				echo '<li><B>MYSQL : <span style="color: green;">Actif</span></B></li>';
			}
		        $data = array();
		        exec('ps ax | grep mysqld | grep -v "grep"', $data, $ret);
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br />";
		                }
		        }
		        else {
		            echo "...";
		        }
		        echo '<hr><br />';

		 ### MAIL -> Postfix ### ???
			if (!preg_match('`master`', $processes)) {
				echo '<li><B>MAIL : <span style="color: red;">Eteint</span></B></li>';
			}
			else {
				echo '<li><B>MAIL : <span style="color: green;">Actif</span></B></li>';
			}
		        $data = array();
		        exec('ps ax | grep -i postfix | grep -v "grep"', $data, $ret);
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br />";
		                }
		        }
		        else {
		            echo "...";
		        }
		        echo '<hr><br />';

		### FTP -> Pure-ftpd ###
			if (!preg_match('`pure-ftpd`', $processes)) {
		                echo '<li><B>FTP : <span style="color: red;">Eteint</span></B></li>';
		        }
		        else {
		                echo '<li><B>FTP : <span style="color: green;">Actif</span></B></li>';
		        }
		        $data = array();
		        exec('ps ax | grep pure-ftpd | grep -v "grep"', $data, $ret);
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br />";
		                }
		        }
		        else {
		            echo "...";
		        }
		        echo '<hr><br />';

		break;
		case 'nginx':

		##### Ajouter ths-access/error-log #####
			echo '<span style:"font-size: 3em;"><B>LOGS NGINX</B></span><br /><br />';
			echo '<B>access.log :</B><br /><br />';
			$data = array();
		        exec('tail -n7 /var/log/nginx/access.log', $data, $ret);
			?><fieldset><?php
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br /><br />";
		                }
		        }
		        else {
		            echo "<span style='color: red;'>Impossible d'afficher <B>NginX/access.log</B> !</span>";
		        }
			?></fieldset><?php
		        echo '<br />';
			echo '<B>error.log :</B><br /><br />';
		        $data = array();
		        exec('tail -n7 /var/log/nginx/error.log', $data, $ret);
			?><fieldset><?php
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br /><br />";
		                }
		        }
		        else {
		            echo "<span style='color: red;'>Impossible d'afficher <B>NginX/error.log</B> !</span>";
		        }
			?></fieldset><?php

		break;
		case 'apache':

			echo '<span style:"font-size: 3em;"><B>LOGS APACHE 2</B></span><br /><br />';
		        echo '<B>access.log :</B><br /><br />';
		        $data = array();
		        exec('tail -n7 /var/log/apache2/access.log', $data, $ret);
			?><fieldset><?php
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br /><br />";
		                }
		        }
		        else {
		            echo "<span style='color: red;'>Impossible d'afficher <B>Apache2/access.log</B> !</span>";
		        }
			?></fieldset><?php
		        echo '<br />';
		        echo '<B>error.log :</B><br /><br />';
		        $data = array();
		        exec('tail -n7 /var/log/apache2/error.log', $data, $ret);
			?><fieldset><?php
		        if ($ret == 0) {
		                foreach ($data as $line) {
		                        echo "$line<br /><br />";
		                }
		        }
		        else {
		            echo "<span style='color: red;'>Impossible d'afficher <B>Apache2/error.log</B> !</span>";
		        }
			?></fieldset><?php
		break;
	}

?>
</div>
