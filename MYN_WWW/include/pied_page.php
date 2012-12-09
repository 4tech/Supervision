<?php
/*
 *      include/pied_page.php
 *
 *      2012, Tdey <devs@tdey.org>
 *
 */
?>
<div id="pied">
	<br>
	<div class="element_pied">
<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://tdey.org/piwik/piwik/" : "http://tdey.org/piwik/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://tdey.org/piwik/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Tag -->
		<?php
			echo $_SERVER['REMOTE_ADDR'].' ';
			echo $queries;
		?> requête(s).
	</div>
</div>
