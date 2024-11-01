<?
require_once(dirname(__FILE__).'/../../../' .'wp-load.php');
global $wpdb;
$arkusz = $wpdb->prefix."oceny";
$ciacho = $_COOKIE['wp-oceny'];
$glos = $_GET['glos'];
$nID = $_GET['nid'];

function srednia_ocena($wspoz, $wsneg)
	{
	if($wspoz>=1&&$wsneg>=1)
		{
		$sr = $wspoz/$wsneg;
		if($sr<0.25) $ocena="1w";
		if($sr>=0.25&&$sr<0.34) $ocena="1";
		if($sr>=0.34&&$sr<0.4) $ocena="1p";
		if($sr>=0.4&&$sr<0.5) $ocena="2m";
		if($sr>=0.5&&$sr<0.67) $ocena="2";
		if($sr>=0.67&&$sr<0.70) $ocena="2p";
		if($sr>=0.70&&$sr<0.73) $ocena="3m";
		if($sr>=0.73&&$sr<0.79) $ocena="3";
		if($sr>=0.79&&$sr<1.84) $ocena="3p";
		if($sr>=1.84&&$sr<3.2) $ocena="4m";
		if($sr>=3.2&&$sr<6.8) $ocena="4";
		if($sr>=6.8&&$sr<10.9) $ocena="4p";
		if($sr>=10.9&&$sr<16.2) $ocena="5m";
		if($sr>=16.2&&$sr<26.9) $ocena="5";
		if($sr>=26.9&&$sr<30.9) $ocena="5p";
		if($sr>=30.9) $ocena="6";
		}
	
	if($wspoz==0&&$wsneg>=1&&$wsneg<3) {$ocena="2m";}
	if($wspoz==0&&$wsneg>=3&&$wsneg<5) {$ocena="1";}
	if($wspoz==0&&$wsneg>=5) {$ocena="1w";}
	
	if($wspoz>=1&&$wspoz<6&&$wsneg==0) {$ocena="5";}
	if($wspoz>=6&&$wsneg==0) {$ocena="6";}
	
	if($wspoz==0&&$wsneg==0) {$ocena="bo";}
	
	return $ocena;
	}

if($_GET['co']=='dodaj')
	{
	if(!strstr($ciacho,$nID.$glos))
		{
		$oceny = $wpdb->get_row("SELECT * FROM $arkusz WHERE `post_id` = $nID");

		$bylo_glosow = $oceny->$glos;
		$jest_glosow = $bylo_glosow+1;

		$nowe_ciacho = $_COOKIE['wp-oceny'].$nID.$glos;
		setcookie("wp-oceny", $nowe_ciacho, time()+31104000, "/");

		$wpdb->query("UPDATE $arkusz SET `$glos` = $jest_glosow WHERE `post_id` = $nID");

		if(!strstr($nowe_ciacho,$nID."p")&&$glos!="i")
			{
			setcookie("wp-oceny", "".$nowe_ciacho.$nID."p", time()+31104000, "/");
			$oceny->poz++;
			$wpdb->query("UPDATE $arkusz SET `poz` = $oceny->poz WHERE `post_id` = $nID");
			}
		if(!strstr($nowe_ciacho,$nID."n")&&$glos=="i")
			{
			setcookie("wp-oceny", "".$nowe_ciacho.$nID."n", time()+31104000, "/");
			$oceny->neg++;
			$wpdb->query("UPDATE $arkusz SET `neg` = $oceny->neg WHERE `post_id` = $nID");
			}
		
		$wpdb->query("UPDATE $arkusz SET `so` = '".srednia_ocena($oceny->poz, $oceny->neg)."' WHERE `post_id` = $nID");

		$oceny->$glos++;

		$oceny_inpost = get_post_meta($nID, "oceny_inpost", true);
		
		if($oceny_inpost[9]!=="1")
			{
			if($oceny_inpost[10]==="1")		$oceny_global = $oceny_inpost;
			else							$oceny_global = get_option("oceny_global");
			
			if(get_option('oceny_wplink')!='off') echo '<div class="w"><a href="http://wiecek.biz/projekty/wordpress/wp-oceny" title="WP Oceny"><img src="/wp-content/plugins/wp-oceny/img/w.png" alt="WP Oceny" /></a></div>';
			
			if($oceny_global[0]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."a"))	{echo '<div id="a" class="oceny_id"><div class="a" onclick="DodajGlos(\'a\')">'.$oceny->a.'</div></div>';}
				else								{echo '<div id="a" class="oceny_id"><div class="a_k" onclick="CofnijGlos(\'a\')">'.$oceny->a.'</div></div>';}
				}

			if($oceny_global[1]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."b"))	{echo '<div id="b" class="oceny_id"><div class="b" onclick="DodajGlos(\'b\')">'.$oceny->b.'</div></div>';}
				else								{echo '<div id="b" class="oceny_id"><div class="b_k" onclick="CofnijGlos(\'b\')">'.$oceny->b.'</div></div>';}
				}

			if($oceny_global[2]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."c"))	{echo '<div id="c" class="oceny_id"><div class="c" onclick="DodajGlos(\'c\')">'.$oceny->c.'</div></div>';}
				else							{echo '<div id="c" class="oceny_id"><div class="c_k" onclick="CofnijGlos(\'c\')">'.$oceny->c.'</div></div>';}
				}

			if($oceny_global[3]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."d"))	{echo '<div id="d" class="oceny_id"><div class="d" onclick="DodajGlos(\'d\')">'.$oceny->d.'</div></div>';}
				else								{echo '<div id="d" class="oceny_id"><div class="d_k" onclick="CofnijGlos(\'d\')">'.$oceny->d.'</div></div>';}
				}

			if($oceny_global[4]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."e"))	{echo '<div id="e" class="oceny_id"><div class="e" onclick="DodajGlos(\'e\')">'.$oceny->e.'</div></div>';}
				else								{echo '<div id="e" class="oceny_id"><div class="e_k" onclick="CofnijGlos(\'e\')">'.$oceny->e.'</div></div>';}
				}

			if($oceny_global[5]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."f"))	{echo '<div id="f" class="oceny_id"><div class="f" onclick="DodajGlos(\'f\')">'.$oceny->f.'</div></div>';}
				else								{echo '<div id="f" class="oceny_id"><div class="f_k" onclick="CofnijGlos(\'f\')">'.$oceny->f.'</div></div>';}
				}

			if($oceny_global[6]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."g"))	{echo '<div id="g" class="oceny_id"><div class="g" onclick="DodajGlos(\'g\')">'.$oceny->g.'</div></div>';}
				else								{echo '<div id="g" class="oceny_id"><div class="g_k" onclick="CofnijGlos(\'g\')">'.$oceny->g.'</div></div>';}
				}

			if($oceny_global[7]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."h"))	{echo '<div id="h" class="oceny_id"><div class="h" onclick="DodajGlos(\'h\')">'.$oceny->h.'</div></div>';}
				else								{echo '<div id="h" class="oceny_id"><div class="h_k" onclick="CofnijGlos(\'h\')">'.$oceny->h.'</div></div>';}
				}

			if($oceny_global[8]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."i"))	{echo '<div id="i" class="oceny_id"><div class="i" onclick="DodajGlos(\'i\')">'.$oceny->i.'</div></div>';}
				else								{echo '<div id="i" class="oceny_id"><div class="i_k" onclick="CofnijGlos(\'i\')">'.$oceny->i.'</div></div>';}
				}

			echo "<div style='clear:both;'/></div>";
			}
		}
	if(function_exists('wp_cache_post_change') && get_option('oceny_wpsupercache')=='on') wp_cache_post_change($nID);
	}

if($_GET['co']=='cofnij')
	{
	if(strstr($_COOKIE['wp-oceny'],$nID.$glos))
		{
		$oceny = $wpdb->get_row("SELECT * FROM $arkusz WHERE `post_id` = $nID");

		$bylo_glosow = $oceny->$glos;
		$jest_glosow = $bylo_glosow-1;

		$nowe_ciacho = str_replace($nID.$glos, '', $_COOKIE['wp-oceny']);
		setcookie("wp-oceny", "".$nowe_ciacho."", time()+31104000, "/");
		
		$wpdb->query("UPDATE $arkusz SET `$glos` = '$jest_glosow' WHERE post_id = '$nID'");

		if(strstr($nowe_ciacho,$nID."p")&&$glos!="i"&&(!strstr($nowe_ciacho,$nID."a"))&&(!strstr($nowe_ciacho,$nID."b"))&&(!strstr($nowe_ciacho,$nID."c"))&&(!strstr($nowe_ciacho,$nID."d"))&&(!strstr($nowe_ciacho,$nID."e"))&&(!strstr($nowe_ciacho,$nID."f"))&&(!strstr($nowe_ciacho,$nID."g"))&&(!strstr($nowe_ciacho,$nID."h")))
			{
			$ciacho_bez_poz = str_replace($nID.'p', '', $nowe_ciacho);
			setcookie("wp-oceny", "".$ciacho_bez_poz."", time()+31104000, "/");
			$oceny->poz--;
			$wpdb->query("UPDATE $arkusz SET `poz` = $oceny->poz WHERE post_id = '$nID'");
			}
		if(strstr($nowe_ciacho,$nID."n")&&$glos=="i")
			{
			$ciacho_bez_neg = str_replace($nID.'n', '', $nowe_ciacho);
			setcookie("wp-oceny", "".$ciacho_bez_neg."", time()+31104000, "/");
			$oceny->neg--;
			$wpdb->query("UPDATE $arkusz SET `neg` = $oceny->neg WHERE post_id = '$nID'");
			}
		
		$wpdb->query("UPDATE $arkusz SET `so` = '".srednia_ocena($oceny->poz, $oceny->neg)."' WHERE post_id = '$nID'");

		$oceny->$glos--;

		$oceny_inpost = get_post_meta($nID, "oceny_inpost", true);
		
		if($oceny_inpost[9]!=="1")
			{
			if($oceny_inpost[10]==="1")		$oceny_global = $oceny_inpost;
			else							$oceny_global = get_option("oceny_global");
			
			if(get_option('oceny_wplink')!='off') echo '<div class="w"><a href="http://wiecek.biz/projekty/wordpress/wp-oceny" title="WP Oceny"><img src="/wp-content/plugins/wp-oceny/img/w.png" alt="WP Oceny" /></a></div>';
			
			if($oceny_global[0]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."a"))	{echo '<div id="a" class="oceny_id"><div class="a" onclick="DodajGlos(\'a\')">'.$oceny->a.'</div></div>';}
				else								{echo '<div id="a" class="oceny_id"><div class="a_k" onclick="CofnijGlos(\'a\')">'.$oceny->a.'</div></div>';}
				}

			if($oceny_global[1]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."b"))	{echo '<div id="b" class="oceny_id"><div class="b" onclick="DodajGlos(\'b\')">'.$oceny->b.'</div></div>';}
				else								{echo '<div id="b" class="oceny_id"><div class="b_k" onclick="CofnijGlos(\'b\')">'.$oceny->b.'</div></div>';}
				}

			if($oceny_global[2]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."c"))	{echo '<div id="c" class="oceny_id"><div class="c" onclick="DodajGlos(\'c\')">'.$oceny->c.'</div></div>';}
				else							{echo '<div id="c" class="oceny_id"><div class="c_k" onclick="CofnijGlos(\'c\')">'.$oceny->c.'</div></div>';}
				}

			if($oceny_global[3]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."d"))	{echo '<div id="d" class="oceny_id"><div class="d" onclick="DodajGlos(\'d\')">'.$oceny->d.'</div></div>';}
				else								{echo '<div id="d" class="oceny_id"><div class="d_k" onclick="CofnijGlos(\'d\')">'.$oceny->d.'</div></div>';}
				}

			if($oceny_global[4]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."e"))	{echo '<div id="e" class="oceny_id"><div class="e" onclick="DodajGlos(\'e\')">'.$oceny->e.'</div></div>';}
				else								{echo '<div id="e" class="oceny_id"><div class="e_k" onclick="CofnijGlos(\'e\')">'.$oceny->e.'</div></div>';}
				}

			if($oceny_global[5]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."f"))	{echo '<div id="f" class="oceny_id"><div class="f" onclick="DodajGlos(\'f\')">'.$oceny->f.'</div></div>';}
				else								{echo '<div id="f" class="oceny_id"><div class="f_k" onclick="CofnijGlos(\'f\')">'.$oceny->f.'</div></div>';}
				}

			if($oceny_global[6]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."g"))	{echo '<div id="g" class="oceny_id"><div class="g" onclick="DodajGlos(\'g\')">'.$oceny->g.'</div></div>';}
				else								{echo '<div id="g" class="oceny_id"><div class="g_k" onclick="CofnijGlos(\'g\')">'.$oceny->g.'</div></div>';}
				}

			if($oceny_global[7]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."h"))	{echo '<div id="h" class="oceny_id"><div class="h" onclick="DodajGlos(\'h\')">'.$oceny->h.'</div></div>';}
				else								{echo '<div id="h" class="oceny_id"><div class="h_k" onclick="CofnijGlos(\'h\')">'.$oceny->h.'</div></div>';}
				}

			if($oceny_global[8]==="1")
				{
				if(!strstr($nowe_ciacho,$nID."i"))	{echo '<div id="i" class="oceny_id"><div class="i" onclick="DodajGlos(\'i\')">'.$oceny->i.'</div></div>';}
				else								{echo '<div id="i" class="oceny_id"><div class="i_k" onclick="CofnijGlos(\'i\')">'.$oceny->i.'</div></div>';}
				}

			echo "<div style='clear:both;'/></div>";
			}
		}
	if(function_exists('wp_cache_post_change')) wp_cache_post_change($nID);
	}

if($_GET['co']=='pokaz')
	{
	global $wpdb, $arkusz;
	
	switch($_GET['glos'])
		{
		case 'a':	echo "<h5>Najfajniejsze posty:</h5>";	break;
		case 'b':	echo "<h5>Najbardziej inspirujące posty:</h5>";	break;
		case 'c':	echo "<h5>Najpiękniejsze posty:</h5>";	break;
		case 'd':	echo "<h5>Najśmieszniejsze posty:</h5>";	break;
		case 'e':	echo "<h5>Najbardziej przydatne posty:</h5>";	break;
		case 'f':	echo "<h5>Najbardziej szokujące posty:</h5>";	break;
		case 'g':	echo "<h5>Najbardziej odkrywcze posty:</h5>";	break;
		case 'h':	echo "<h5>Najciekawsze posty:</h5>";	break;
		case 'i':	echo "<h5>Najgorsze posty:</h5>";	break;
		}
	echo $socena;
	
	echo "<ul style='margin-left: 30px; list-style-type: disc'>";
	
	$najlepsze = $wpdb->get_results("SELECT * FROM $arkusz LEFT JOIN $wpdb->posts ON ($arkusz.post_id = $wpdb->posts.ID) WHERE ".$_GET['glos']." >= 1 ORDER BY ".$_GET['glos']." DESC LIMIT 0,10");
	foreach ($najlepsze as $najlepszy)
		{
		echo "<li><a href='".get_permalink($najlepszy->post_id)."' title='".$najlepszy->post_title."'>".$najlepszy->post_title."</a> (głosów: ".$najlepszy->$_GET['glos'].")</li>";
		}
	
	echo "</ul>";
	}
?>
