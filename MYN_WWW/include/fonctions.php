<?php
/*
 *  	include/fonctions.php - Contient les fonctions "globales".
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */


function db_connect()
{
    //Définition des variables de connexion à la base de données
    $bd_serveur='localhost';
    /*$bd_login=DBLOGIN;
    $bd_pass=DBPASS;
    $bd_nom=DBBASE;*/

    //Connexion à la base de données
    mysql_connect($bd_serveur, DBLOGIN, DBPASS);
    mysql_select_db(DBBASE);
    mysql_query("set names 'utf8'");
}


function queries($num = 1)
{
    global $queries;
    $queries = $queries + intval($num);
}


function sqlquery($requete, $number)
{
    $query = mysql_query($requete) or exit('Erreur SQL : '.mysql_error().' Ligne : '. __LINE__ .'.'); //requête
    queries();
    /*
    Deux cas possibles ici :
    Soit on sait qu'on a qu'une seule entrée qui sera
    retournée par SQL, donc on met $number à 1
    Soit on ne sait pas combien seront retournées,
    on met alors $number à 2.
    */
    if($number == 1)
    {
        $query1 = mysql_fetch_assoc($query);
        mysql_free_result($query);
        /*mysql_free_result($query) libère le contenu de $query, je
        le fais par principe, mais c'est pas indispensable.*/
        return $query1;
    }
    else if($number == 2)
    {
        while($query1 = mysql_fetch_assoc($query))
        {
            $query2[] = $query1;
            /*On met $query1 qui est un array dans $query2 qui
            est un array. Ca fait un array d'arrays :o*/
        }
        mysql_free_result($query);
        return $query2;
    }
    else //Erreur
    {
        exit('Argument de sqlquery non renseigné ou incorrect.');
    }
}


function actualiser_session()
{
    //echo 'plop de débogage';
    if(isset($_SESSION['mbrid']) && intval($_SESSION['mbrid']) != 0) //Vérification id
    {
        //utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
        $retour = sqlquery("SELECT mbrid, pseudo, mbrpass, niveau, avatar, mail FROM membresok WHERE mbrid = ".intval($_SESSION['mbrid']), 1);
        //Si la requête a un résultat (i.e l'id existe dans la table membresok)
        if(isset($retour['pseudo']) && $retour['pseudo'] != '')
        {
            $_SESSION['projet'] = array();
            $zzw = mysql_query("SELECT namepjt FROM projetx WHERE mbrpjt='".$retour['pseudo']."' AND nivpjt<>'adminprojet'") or die("Erreur SQL : ".mysql_error());
            $ini = mysql_query("SELECT namepjt FROM projetx WHERE mbrpjt='".$retour['pseudo']."' AND nivpjt='adminprojet'") or die("Erreur SQL : ".mysql_error());
            if($ini != '')
            {
                $init = mysql_fetch_array($ini);
            }
            else
            {
                $ini2 = mysql_query("SELECT pjt_pcpl FROM membresok WHERE mbrid='".$_SESSION['mbrid']."'") or die('Erreur SQL : '.mysql_error());
                $init = mysql_fetch_array($ini2);
            }
            if($init != '')
            {
                if(isset($_SESSION['pjt_defaut']))
                {
                    $_SESSION['projet'][0] = $_SESSION['pjt_defaut'];
                    $_SESSION['projet'][1] = $init[0];
                }
                else
                {
                    $_SESSION['projet'][0] = $init[0];
                }
            }
            else
            {
                if(isset($_SESSION['pjt_defaut']))
                {
                    $_SESSION['projet'][0] = $_SESSION['pjt_defaut'];
                    $_SESSION['projet'][1] = 'Site';
                }
                else
                {
                    $_SESSION['projet'][0] = 'Site';
                }
            }
            while($zzx = (mysql_fetch_array($zzw)))
            {
                $_SESSION['projet'][] = $zzx[0];
            }
            if($_SESSION['mbrpass'] != $retour['mbrpass'])
            {
                //Refus de validation.
                $informations = Array(
                        true,
                        'Session invalide',
                        'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.<br /><br />',
                        '',
                        'connexion.php',
                        3
                        );
                require_once('../infos.php');
                vider_cookie();
                session_destroy();
                exit();
            }
            else
            {
                //Validation de la session.
                $_SESSION['mbrid'] = $retour['mbrid'];
                $_SESSION['pseudo'] = $retour['pseudo'];
                $_SESSION['mbrpass'] = $retour['mbrpass'];
                $_SESSION['niveau'] = $retour['niveau'];
                $_SESSION['avatar'] = $retour['avatar'];
                $_SESSION['mail'] = $retour['mail'];
                if($_SESSION['projet'][0] == $init[0])
                {
                    $_SESSION['auth'] = 'ok';
                }
                else
                {
                    $_SESSION['auth'] = 'non';
                }
                if($retour['niveau'] == 'adminprojet')
                mysql_query("UPDATE membresok SET dernvisit = ".time()." WHERE mbrid = ".$_SESSION['mbrid']) or exit(mysql_error());
                queries();
            }
        }
    }
    else //On vérifie les cookies et sinon pas de session
    {
        if(isset($_COOKIE['mbrid']) && isset($_COOKIE['mbrpass'])) //S'il en manque un, pas de session.
        {
            if(intval($_COOKIE['mbrid']) != 0)
            {
                //idem qu'avec les $_SESSION
                $retour = sqlquery("SELECT mbrid, pseudo, mbrpass, niveau FROM membresok WHERE mbrid = ".intval($_COOKIE['mbrid']), 1);
                if(isset($retour['pseudo']) && $retour['pseudo'] != '')
                {
                    if($_COOKIE['mbrpass'] != $retour['mbrpass'])
                    {
                        //"Refoulage" de l'intrus :p
                        $informations = Array(/*Mot de passe de cookie incorrect*/
                                true,
                                'Mot de passe - cookie erroné',
                                'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.<br /><br />',
                                '',
                                'connexion.php',
                                3
                                );
                        require_once('../infos.php');
                        vider_cookie();
                        session_destroy();
                        exit();
                    }
                    else
                    {
                        //Bienvenue :D
                        $_SESSION['mbrid'] = $retour['mbrid'];
                        $_SESSION['pseudo'] = $retour['pseudo'];
                        $_SESSION['mbrpass'] = $retour['mbrpass'];
                        $_SESSION['niveau'] = $retour['niveau'];
                        $_SESSION['avatar'] = $retour['avatar'];
                        $_SESSION['mail'] = $retour['mail'];
                        mysql_query("UPDATE membresok SET dernvisit = ".time()." WHERE mbrid = ".$_SESSION['mbrid']) or exit(mysql_error());
                        queries();
                    }
                }
            }
            else //cookie invalide, erreur plus suppression des cookies.
            {
                $informations = Array(/*L'id de cookie est incorrect*/
                        true,
                        'Cookie invalide',
                        'Le cookie conservant votre id est corrompu, il va donc être détruit vous devez vous reconnecter.<br /><br />',
                        '',
                        'connexion.php',
                        3
                        );
                require_once('../infos.php');
                vider_cookie();
                session_destroy();
                exit();
            }
        }
        else
        {
            //Fonction de suppression de toutes les variables de cookie.
            if(isset($_SESSION['mbrid'])) unset($_SESSION['mbrid']);
            vider_cookie();
        }
    }
    if(isset($_SESSION['mbrid'])) $id = $_SESSION['mbrid'];
    else $id = -1;
    updateConnectes($id);
}


function updateConnectes($id)
{
    $ip = getIp();
    if($id != -1)
    {
        $id = $_SESSION['mbrid'];
        $additionnal = 1; //la variable à mettre dans connectes_membre
    }
    else
    {
        $additionnal = $ip;
    }
    mysql_query("DELETE FROM connectes WHERE connectes_actualisation < ".(time()-1600)) or exit(mysql_error()); //MàJ générale des connectés
    mysql_query("INSERT INTO connectes VALUES(".$id.", '".$ip."', '".$additionnal."', ".time().")
    ON DUPLICATE KEY UPDATE connectes_actualisation=".time().", connectes_ip='".$ip."'") or exit(mysql_error()); //on "duplicate"
    queries(2);
}


function getIp()
{
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    else return $_SERVER['REMOTE_ADDR'];
}


function vider_cookie()
{
    foreach($_COOKIE as $cle => $element)
    {
        setcookie($cle, '', time()-3600);
    }
}


function checkpseudo($pseudo)
{
    if($pseudo == '') return 'empty';
    else if(strlen($pseudo) < 3) return 'tooshort';
    else if(strlen($pseudo) > 32) return 'toolong';
    else
    {
        $result = sqlquery("SELECT COUNT(*) AS nbr FROM membresok WHERE pseudo = '".mysql_real_escape_string($pseudo)."'", 1);
        global $queries;
        $queries++;
        if($result['nbr'] > 0) return 'exists';
        else return 'ok';
    }
}


function checkmdp($mdp)
{
    if($mdp == '') return 'empty';
    else if(strlen($mdp) < 4) return 'tooshort';
    else if(strlen($mdp) > 50) return 'toolong';
    else
    {
        if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
        else if(!preg_match('#[A-Z]{1,}#', $mdp)) return 'noupcap';
        else return 'ok';
    }
}


function checkmdpS($mdp, $mdp_verif)
{
    if($mdp != $mdp_verif && $mdp != '' && $mdp_verif != '') return 'different';
    else return checkmdp($mdp);
}


function checkmail($mail)
{
    if($mail == '') return 'empty';
    else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $mail)) return 'isnt';
    else
    {
        $result = sqlquery("SELECT COUNT(*) AS nbr FROM membresok WHERE mail = '".mysql_real_escape_string($mail)."'", 1);
        global $queries;
        $queries++;
        if($result['nbr'] > 0) return 'exists';
        else return 'ok';
    }
}


function checkmailS($mail, $mail_verif)
{
    if($mail != $mail_verif && $mail != '' && $mail_verif != '') return 'different';
    else return 'ok';
}


function birthdate($date_naissance)
{
    if($date_naissance == '') return 'empty';
    else if(substr_count($date_naissance, '/') != 2) return 'format';
    else
    {
        $DATE = explode('/', $date_naissance);
        if(date('Y') - $DATE[2] <= 12) return 'tooyoung';
        else if(date('Y') - $DATE[2] >= 120) return 'tooold';
        else if($DATE[2]%4 == 0)
        {
            $maxdays = Array('31', '29', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
            if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
            else return 'ok';
        }
        else
        {
            $maxdays = Array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
            if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
            else return 'ok';
        }
    }
}


function vidersession()
{
    foreach($_SESSION as $cle => $element)
    {
        unset($_SESSION[$cle]);
    }
}


function inscription_mail($mail, $pseudo, $mdp)
{
    $admino = mysql_query('SELECT admin FROM reglages') or die ("Erreur SQL : ".mysql_error());
    $admini = mysql_fetch_array($admino);
    $admin = $admini['admin'];
    $to = $mail;
    $subject = 'Inscription sur Tdey Horror Show - '.$pseudo;
    $message = '<html>
                    <head>
                        <title></title>
                    </head>

                    <body>
                        <div><a href="http://horror.tdey.org" title="TdeyHorrorShow"><img src="http://horror.tdey.org/imgs/vignettes/tdeyhorrorshow.png"/></a><br/><br/>
                        Bienvenue sur Tdey Horror Show !<br/><br/>
                        Vous avez complété une inscription avec le pseudo
                        '.htmlspecialchars($pseudo, ENT_QUOTES).' à l\'instant.<br/>
                        Votre mot de passe est : '.htmlspecialchars($mdp, ENT_QUOTES).'.<br/>
                        Veillez à le garder secret et à ne pas l\'oublier.<br/><br/>
                        Vous pouvez vous connectez en suivant <a href="http://horror.tdey.org/membres/connexion.php" style="color:red; font-weight:bold">ce lien</a>.<br/>

                        En vous remerciant.<br/><br/>
                        L\'équipe du Tdey Horror Show
                    </body>
                </html>';
    //headers principaux.
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'Content-Transfer-Encoding: 8bit';
    //headers supplémentaires
    $headers .= 'From: "Tdey Horror Show" <'.$admin.'>' . "\r\n";
    $headers .= 'Cc: "Duplicata" <'.$admin.'>' . "\r\n";
    $headers .= 'Reply-To: "devs" ' . "\r\n";
    $mail = mail($to, $subject, $message, $headers); //marche
    if($mail) return true;
    return false;
}


function get($type)
{
    if($type == 'nb_membres')
    {
        $count = sqlquery("SELECT COUNT(*) AS nbr FROM membresok", 1);
        return $count['nbr'];
    }
    else if($type == 'connectes')
    {
        $count = sqlquery("SELECT COUNT(*) AS nbr FROM connectes", 1);
        return $count['nbr'];
    }

    else
    {
        return 0;
    }
}


function date_fr($date)
{
    $date_en = date($date);
    $anglais = array(
    "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",
    "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday",
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    );
    $francais = array(
    "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim",
    "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche",
    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
    );
    $date_fr = str_replace($anglais, $francais, $date);
    return $date_fr;
}


function mepd($date)
{
    if(intval($date) == 0) return $date;
    $tampon = time();
    $diff = $tampon - $date;
    $dateDay = date('d', $date);
    $dateMonth = date('m', $date);
    $dateYear = date('Y', $date);
    $tamponDay = date('d', $tampon);
    $diffDay = $tamponDay - $dateDay;
    if($diff < 60 && $diffDay == °)
    {
        return 'Il y a '.$diff.'s';
    }
    else if($diff < 600 && $diffDay == 0)
    {
        return 'Il y a '.floor($diff/60).'m et '.floor($diff%60).'s';
    }
    else if($diff < 3600 && $diffDay == 0)
    {
        return 'Il y a '.floor($diff/60).'m';
    }
    else if($diff < 21600 && $diffDay == 0)
    {
        return 'Il y a '.floor($diff/3600).'h et '.floor(($diff%3600)/60).'m';
    }
    else if($diff < 24*3600 && $diff > 21600 )//$diffDay == 0)
    {
        return 'Aujourd\'hui à '.date('H\hi', $date);
    }
    else if($diff < 48*3600 && $diff > 24*3600)//$diffDay == 1)
    {
        return 'Hier à '.date('H\hi', $date);
    }
    else if($diff > 48*3600)//$diffDay >= 2)
    {
        //return '**'.$dateDay.'*'.$dateMonth.'*'.$dateYear.'*'.$date;
        return 'Le '.date_fr(date('l\ d\ F\ Y',$date)).' à '.date('H\:i',$date);
    }
}


function pagination($url,$parpage,$nblignes,$nbpages)
{
    // On crée le code html pour la pagination
    $html = precedent($url,$parpage,$nblignes); // On crée le lien precedent
    // On vérifie que l'on a plus d'une page à afficher
    if ($nbpages > 1) {
        // On boucle sur les numéros de pages à afficher
        for ($i = 0 ; $i < $nbpages ; ++$i) {
            $limit = $i * $parpage; // On calcule le début de la valeur 'limit'
            $limit = $limit.",".$parpage; // On fait une concaténation avec $parpage
            // On affiche les liens des numéros de pages
            $html .= "<a class='liens' href='".$url."=".$limit."' title='Aller à cette page'>".($i + 1)."</a><a class='liens2'> | </a>" ;
        }
    }
    // Si l'on a qu'une page on affiche rien
    else
    {
        $html .= "";
    }
    $html .= suivant($url,$parpage,$nblignes); // On crée le lien suivant
    // On retourne le code html
    return $html;
}


function validlimit($nblignes,$parpage,$sql)
{
    // On vérifie l'existence de la variable $_GET['limit']
    // $limit correspond à la clause LIMIT que l'on ajoute à la requête $sql
    if (isset($_GET['limit']))
    {
        $pointer = split('[,]', $_GET['limit']); // On scinde $_GET['limit'] en 2
        $debut = $pointer[0];
        $fin = $pointer[1];
        // On vérifie la conformité de la variable $_GET['limit']
        if (($debut >= 0) && ($debut < $nblignes) && ($fin == $parpage))
        {
            // Si $_GET['limit'] est valide on lance la requête pour afficher la page
            $limit = $_GET['limit']; // On récupère la valeur 'limit' passée par url
            $sql .= " LIMIT ".$limit.";"; // On ajoute $limit à la requête $sql
            $result = mysql_query($sql) or die ("Erreur SQL : ".mysql_error()); // Nouveau résultat de la requête
        }
        // Sinon on affiche la première page
        else
        {
            $sql .= " LIMIT 0,".$parpage.";"; // On ajoute la valeur LIMIT à la requête
            $result = mysql_query($sql) or die ("Erreur SQL : ".mysql_error()); // Nouveau résultat de la requête
        }
    }
    // Si la valeur 'limit' n'est pas connue, on affiche la première page
    else
    {
        $sql .= " LIMIT 0,".$parpage.";"; // On ajoute la valeur LIMIT à la requête
        $result = mysql_query($sql) or die ("Erreur SQL : ".mysql_error()); // Nouveau résultat de la requête
    }
    // On retourne le résultat de la requête
    return $result;
}


function precedent($url,$parpage,$nblignes)
{
    // On vérifie qu'il y a au moins 2 pages à afficher
    if ($nblignes > $parpage)
    {
        // On vérifie l'existence de la variable $_GET['limit']
        if (isset($_GET['limit']))
        {
            // On scinde la variable 'limit' en utilisant la virgule comme séparateur
            $pointer = split('[,]', $_GET['limit']);
            // On récupère le nombre avant la virgule et on soustrait la valeur $parpage
            $pointer = $pointer[0]-$parpage;
            // Si on atteint la première page, pas besoin de lien 'Précédent'
            if ($pointer < 0)
            {
                $precedent = "";
            }
            // Sinon on affiche le lien avec l'url de la page précédente
            else
            {
                $limit = "$pointer,$parpage";
                $une = 0;
                $precedent = "<a class='liens2' href=".$url.$une.",".$parpage." title='Première page'>1ère</a> <a class='liens' href=".$url.$limit." title='Page précédente'><<</a><a class='liens2'> | </a>";
            }
        }
        else
        {
            $precedent = ""; // On est à la première page, pas besoin de lien 'Précédent'
        }
    }
    else
    {
        $precedent = ""; // On a qu'une page, pas besoin de lien 'Précédent'
    }
    return $precedent;
}


function suivant($url,$parpage,$nblignes)
{
    // On vérifie qu'il y a au moins 2 pages à afficher
    if ($nblignes > $parpage)
    {
        // On vérifie l'existence de la variable $_GET['limit']
        if (isset($_GET['limit']))
        {
            // On scinde la variable 'limit' en utilisant la virgule comme séparateur
            $pointer = split('[,]', $_GET['limit']);
            // On récupère le nombre avant la virgule auquel on ajoute la valeur $parpage
            $pointer = $pointer[0] + $parpage;
            // Si on atteint la dernière page, pas besoin de lien 'Suivant'
            if ($pointer >= $nblignes)
            {
                $suivant = "";
            }
            // Sinon on affiche le lien avec l'url de la page suivante
            else
            {
                $limit = "$pointer,$parpage";
                $derniere = $nblignes-$parpage;
                $suivant = "<a class='liens' href=".$url.$limit." title='Page suivante'>>></a> <a class='liens2' href=".$url.$derniere.",".$parpage." title='Dernière page'> Dernière</a>";
            }
        }
        // Si pas de valeur 'limit' on affiche le lien de la deuxième page
        if (@$_GET['limit']== false)
        {
            $suivant = "<a class='liens' href=".$url.$parpage.",".$parpage." title='Page suivante'>></a>";
        }
    }
    else
    {
        $suivant = ""; // On a qu'une page, pas besoin de lien 'Suivant'
    }
    return $suivant;
}

function countMedias()
{
$nbr_video = mysql_query('SELECT COUNT(cat) AS nbr FROM medias WHERE proprio="'.$_SESSION['pseudo'].'" AND cat="video"') or die ("Erreur SQL : ".mysql_error());
$nb_video = mysql_result($nbr_video,0);
if(($nbr_video) == '') $nb_video = 0;
$nbr_audio = mysql_query('SELECT COUNT(cat) AS nbr FROM medias WHERE proprio="'.$_SESSION['pseudo'].'" AND cat="audio"') or die ("Erreur SQL : ".mysql_error());
$nb_audio = mysql_result($nbr_audio,0);
if(($nbr_audio) == '') $nb_audio = 0;
$nbr_image = mysql_query('SELECT COUNT(cat) AS nbr FROM medias WHERE proprio="'.$_SESSION['pseudo'].'" AND cat="images"') or die ("Erreur SQL : ".mysql_error());
$nb_image = mysql_result($nbr_image,0);
if(($nbr_image) == '') $nb_image = 0;
$_SESSION['nb_videoxx'] = $nb_video;
$_SESSION['nb_audioxx'] = $nb_audio;
$_SESSION['nb_imagexx'] = $nb_image;
}


function format_taille($taille)
{
    if ($taille < 1024) return $taille.' o';
    elseif ($taille < 1048576) return round($taille / 1024, 2).' ko';
    elseif ($taille < 1073741824) return round($taille / 1048576, 2).' Mo';
    elseif ($taille < 1099511627776) return round($taille / 1073741824, 2).' Go';
    else return round($taille / 1099511627776, 2).' To';
}

/*function colorstatus($splop)
{
        if ($splop = "OK"); then
            couleur = "green";
        elseif ($splop = "NO"); then
            couleur = red;
        elseif ($splop = "DOWN"); then
            couleur = red;
        elseif ($splop = "UNKNOWN"); then
            couleur = orange;
        else
            return;
}*/

?>
