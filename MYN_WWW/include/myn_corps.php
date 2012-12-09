<?php
/*
 *      include/myn_corps.php
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
?>
<div class="articles_titre">
    <br/>Vue Globale des Périphériques
    <div class="articles_date">
        <?php echo date_fr(date('l d F Y') . ', ' . date('H\hi') . '.'); ?>
    </div>
</div>
<div class="corps1">

    <!-- ROUTEURS -->
        <div class="article">
            <h1 class="etoile">
            <?php echo "ROUTEURS"; ?></h1>
                <table cellspacing="2px" cellpadding="2px;" rules="all" style="border:solid 1px black;">
                    </thead>
                        <tr>
                            <th> Hostname </th>
                            <th> Service </th>
                            <th> Status </th>
                            <th> retry </th>
                            <th> Ack Status </th>
                            <th> Ack User </th>
                            <th> Date </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM myn_routers_generic";     // Requête originale
                        $total = mysql_query($sql) or die ("Erreur SQL : ".mysql_error());  // mysql et die pour ne pas bloquer l'affichage de la page en cas d'erreur
                        $nblignes = mysql_num_rows($total);             // On compte le nombre total de lignes
                        $parpage = 50;                                  // Servira plus tard pour ne pas surcharger la page -> revoir la pagination.
                        $result = validlimit($nblignes,$parpage,$sql);  // Passage à la moulinette
                        while ($donnees = mysql_fetch_array($result))   // Boucle pour afficher les éléments sélectionnés de chaque ligne dans un tableau
                        {
                            $splop = array($donnees['rout_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "OK":
                                        $coulsrv="green";
                                    break;
                                    case "NO":
                                    case "DOWN":
                                        $coulsrv="red";
                                    break;
                                    case "UNKNOWN":
                                        $coulsrv="orange";
                                    break;
                                };
                            };
                            $splop = array($donnees['rout_ack_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "YES":
                                    case "OK":
                                        $coulack="green";
                                    break;
                                    case "NO":
                                        $coulack="red";
                                    break;
                                    case "none":
                                        $coulack="white";
                                    break;
                                };
                            };
                            echo "<tr>
                            <td>".$donnees['rout_hostname']."</td>
                            <td>".$donnees['rout_services']."</td>
                            <td style=\"background-color:$coulsrv;color:black;\" >".$donnees['rout_status']."</td>
                            <td>".$donnees['rout_retry']."</td>
                            <td style=\"background-color:$coulack;color:black;\" >".$donnees['rout_ack_status']."</td>
                            <td>".$donnees['rout_ack_user']."</td>
                            <td>".$donnees['date_time']."</td>
                        </tr>";
                        }
                    ?>
                   </tbody>
                </table>
            <br />
        </div>
    <br />

    <!-- SWITCHES -->
        <div class="article">
            <h1 class="etoile">
            <?php echo "SWITCHES"; ?></h1>
                <table cellspacing="2px" cellpadding="2px;" rules="all" style="border:solid 1px black;">
                    </thead>
                        <tr>
                            <th> Hostname </th>
                            <th> Service </th>
                            <th> Status </th>
                            <th> retry </th>
                            <th> Ack Status </th>
                            <th> Ack User </th>
                            <th> Date </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM myn_switches_generic";
                        $total = mysql_query($sql) or die ("Erreur SQL : ".mysql_error());
                        $nblignes = mysql_num_rows($total);
                        $parpage = 4;
                        $result = validlimit($nblignes,$parpage,$sql);
                        while ($donnees = mysql_fetch_array($result))
                        {
                            $splop = array($donnees['sw_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "OK":
                                        $coulsrv="green";
                                    break;
                                    case "NO":
                                    case "DOWN":
                                        $coulsrv="red";
                                    break;
                                    case "UNKNOWN":
                                        $coulsrv="orange";
                                    break;
                                };
                            };
                            $splop = array($donnees['sw_ack_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "OK":
                                    case "YES":
                                        $coulack="green";
                                    break;
                                    case "NO":
                                        $coulack="red";
                                    break;
                                    case "none":
                                        $coulack="white";
                                    break;
                                };
                            };
                        echo "<tr>
                            <td>".$donnees['sw_hostname']."</td>
                            <td>".$donnees['sw_services']."</td>
                            <td style=\"background-color:$coulsrv;color:black;\" >".$donnees['sw_status']."</td>
                            <td>".$donnees['sw_retry']."</td>
                            <td style=\"background-color:$coulack;color:black;\" >".$donnees['sw_ack_status']."</td>
                            <td>".$donnees['sw_ack_user']."</td>
                            <td>".$donnees['date_time']."</td>
                        </tr>";
                        }
                    ?>
                   </tbody>
                </table>
            <br />
        </div>
    <br />

    <!-- SERVERS -->
        <div class="article">
            <h1 class="etoile">
            <?php echo "SERVERS"; ?></h1>
                <table cellspacing="2px" cellpadding="2px;" rules="all" style="border:solid 1px black;">
                    </thead>
                        <tr>
                            <th> Hostname </th>
                            <th> Service </th>
                            <th> Status </th>
                            <th> retry </th>
                            <th> Ack Status </th>
                            <th> Ack User </th>
                            <th> Date </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM myn_servers_generic";
                        $total = mysql_query($sql) or die ("Erreur SQL : ".mysql_error());
                        $nblignes = mysql_num_rows($total);
                        $parpage = 4;
                        $result = validlimit($nblignes,$parpage,$sql);
                        while ($donnees = mysql_fetch_array($result))
                        {
                            $splop = array($donnees['srv_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "OK":
                                        $coulsrv="green";
                                    break;
                                    case "NO":
                                    case "DOWN":
                                        $coulsrv="red";
                                    break;
                                    case "UNKNOWN":
                                        $coulsrv="orange";
                                    break;
                                };
                            };
                            $splop = array($donnees['srv_ack_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "OK":
                                    case "YES":
                                        $coulack="green";
                                    break;
                                    case "NO":
                                        $coulack="red";
                                    break;
                                    case "none":
                                        $coulack="white";
                                    break;
                                };
                            };
                        echo "<tr>
                            <td>".$donnees['srv_hostname']."</td>
                            <td>".$donnees['srv_services']."</td>
                            <td style=\"background-color:$coulsrv;color:black;\" >".$donnees['srv_status']."</td>
                            <td>".$donnees['srv_retry']."</td>
                            <td style=\"background-color:$coulack;color:black;\" >".$donnees['srv_ack_status']."</td>
                            <td>".$donnees['srv_ack_user']."</td>
                            <td>".$donnees['date_time']."</td>
                        </tr>";
                        }
                    ?>
                   </tbody>
                </table>
            <br />
        </div>
    <br />

    <!-- PRINTERS -->
        <div class="article">
            <h1 class="etoile">
            <?php echo "PRINTERS"; ?></h1>
                <table cellspacing="2px" cellpadding="2px;" rules="all" style="border:solid 1px black;">
                    </thead>
                        <tr>
                            <th> Hostname </th>
                            <th> Service </th>
                            <th> Status </th>
                            <th> retry </th>
                            <th> Ack Status </th>
                            <th> Ack User </th>
                            <th> Date </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM myn_printers_generic";
                        $total = mysql_query($sql) or die ("Erreur SQL : ".mysql_error());
                        $nblignes = mysql_num_rows($total);
                        $parpage = 4;
                        $result = validlimit($nblignes,$parpage,$sql);
                        while ($donnees = mysql_fetch_array($result))
                        {
                            $splop = array($donnees['lpd_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "OK":
                                        $coulsrv="green";
                                    break;
                                    case "NO":
                                    case "DOWN":
                                        $coulsrv="red";
                                    break;
                                    case "UNKNOWN":
                                        $coulsrv="orange";
                                    break;
                                };
                            };
                            $splop = array($donnees['lpd_ack_status']);    // A mettre dans le /include/fonctions.php quand ça marchera
                            foreach($splop as $flip) {
                                switch ($flip) {                        // Choix de la couleur d'affichage en fonction de la valeur
                                    case "OK":
                                    case "YES":
                                        $coulack="green";
                                    break;
                                    case "NO":
                                        $coulack="red";
                                    break;
                                    case "none":
                                        $coulack="white";
                                    break;
                                };
                            };
                        echo "<tr>
                            <td>".$donnees['lpd_hostname']."</td>
                            <td>".$donnees['lpd_services']."</td>
                            <td style=\"background-color:$coulsrv;color:black;\" >".$donnees['lpd_status']."</td>
                            <td>".$donnees['lpd_retry']."</td>
                            <td style=\"background-color:$coulack;color:black;\" >".$donnees['lpd_ack_status']."</td>
                            <td>".$donnees['lpd_ack_user']."</td>
                            <td>".$donnees['date_time']."</td>
                        </tr>";
                        }
                    ?>
                   </tbody>
                </table>
            <br />
        </div>
    <br />



    <div class="navig">
    <!--Trier par : Date - Projet - Catégorie - Titre-->
<?php
//      mysql_free_result($result); // On libère la mémoire
//      echo pagination($url,$parpage,$nblignes,$nbpages);
        echo "</div>";
    ?>
</div>
