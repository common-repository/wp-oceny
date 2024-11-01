<?
/*
Plugin Name: WP Oceny
Plugin URI: http://wiecek.biz/projekty/wordpress/wp-oceny
Description: Wtyczka umożliwiająca odwiedzającym ocenianie postów.
Version: 0.6.1
Author: Łukasz Więcek
Author URI: http://wiecek.biz/
*/
$wersja = "0.6.1";

$arkusz = $wpdb->prefix."oceny";

function oceny_ustawienia()
	{
	echo '<div class="wrap">';
	echo '<h2>Konfiguracja ocen</h2>';

	global $wpdb, $arkusz, $wersja;

	if(isset($_POST['zainstaluj']))
		{
		$wpdb->query("CREATE TABLE $arkusz (`ID` BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, `post_id` BIGINT(20) NOT NULL DEFAULT '0', `poz` BIGINT(20) NOT NULL DEFAULT '0', `neg` BIGINT(20) NOT NULL DEFAULT '0', `a` BIGINT(20) NOT NULL DEFAULT '0', `b` BIGINT(20) NOT NULL DEFAULT '0', `c` BIGINT(20) NOT NULL DEFAULT '0', `d` BIGINT(20) NOT NULL DEFAULT '0', `e` BIGINT(20) NOT NULL DEFAULT '0', `f` BIGINT(20) NOT NULL DEFAULT '0', `g` BIGINT(20) NOT NULL DEFAULT '0', `h` BIGINT(20) NOT NULL DEFAULT '0', `i` BIGINT(20) NOT NULL DEFAULT '0', `so` ENUM('bo','6','5p','5','5m','4p','4','4m','3p','3','3m','2p','2','2m','1p','1','1w') NOT NULL DEFAULT 'bo', INDEX (`post_id`)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = MyISAM");
		$pobierz_posty = $wpdb->get_results("SELECT ID, post_type FROM $wpdb->posts WHERE `post_type` LIKE 'post'");
		foreach($pobierz_posty as $pobierz_post)
			{$wpdb->query("INSERT INTO $arkusz VALUES ('', '".$pobierz_post->ID."', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'bo')");}

		add_option('oceny_global_a', 'on', ' ', 'no');
		add_option('oceny_global_b', 'on', ' ', 'no');
		add_option('oceny_global_c', 'on', ' ', 'no');
		add_option('oceny_global_d', 'on', ' ', 'no');
		add_option('oceny_global_e', 'on', ' ', 'no');
		add_option('oceny_global_f', 'on', ' ', 'no');
		add_option('oceny_global_g', 'on', ' ', 'no');
		add_option('oceny_global_h', 'on', ' ', 'no');
		add_option('oceny_global_i', 'on', ' ', 'no');
		
		add_option('oceny_ver', $wersja, ' ', 'no');
		}
	
	if(isset($_POST['zapisz']))
		{
		if(get_option('oceny_ver')) {update_option('oceny_ver', $wersja);}
		else{add_option('oceny_ver', $wersja, ' ', 'no');}

		if($_POST['oceny_wpsupercache']=='on')
			{if(get_option('oceny_wpsupercache')) {update_option('oceny_wpsupercache', 'on');}
			else{add_option('oceny_wpsupercache', 'on', ' ', 'no');}}
		else{if(get_option('oceny_wpsupercache')) {update_option('oceny_wpsupercache', 'off');}
			else{add_option('oceny_wpsupercache', 'off', ' ', 'no');}}

		if($_POST['oceny_indashboard']=='on')
			{if(get_option('oceny_indashboard')) {update_option('oceny_indashboard', 'on');}
			else{add_option('oceny_indashboard', 'on', ' ', 'no');}}
		else{if(get_option('oceny_indashboard')) {update_option('oceny_indashboard', 'off');}
			else{add_option('oceny_indashboard', 'off', ' ', 'no');}}

		if($_POST['oceny_inadmin']=='on')
			{if(get_option('oceny_inadmin')) {update_option('oceny_inadmin', 'on');}
			else{add_option('oceny_inadmin', 'on', ' ', 'no');}}
		else{if(get_option('oceny_inadmin')) {update_option('oceny_inadmin', 'off');}
			else{add_option('oceny_inadmin', 'off', ' ', 'no');}}

		if($_POST['oceny_wplink']=='on')
			{if(get_option('oceny_wplink')) {update_option('oceny_wplink', 'on');}
			else{add_option('oceny_wplink', 'on', ' ', 'no');}}
		else{if(get_option('oceny_wplink')) {update_option('oceny_wplink', 'off');}
			else{add_option('oceny_wplink', 'off', ' ', 'no');}}

		if($_POST['global_a']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_b']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_c']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_d']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_e']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_f']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_g']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_h']=='on') $oceny_global .= "1"; else $oceny_global .= "0";
		if($_POST['global_i']=='on') $oceny_global .= "1"; else $oceny_global .= "0";

		if(get_option('oceny_global')) {update_option('oceny_global', $oceny_global);}
			else{add_option('oceny_global', $oceny_global, ' ', 'yes');}
		}

	if(isset($_POST['usun']))
		{
		global $wpdb, $arkusz, $table_prefix;

		if(get_option('oceny'))					delete_option('oceny');
		if(get_option('oceny_global_a'))		delete_option('oceny_global_a');
		if(get_option('oceny_global_b'))		delete_option('oceny_global_b');
		if(get_option('oceny_global_c'))		delete_option('oceny_global_c');
		if(get_option('oceny_global_d'))		delete_option('oceny_global_d');
		if(get_option('oceny_global_e'))		delete_option('oceny_global_e');
		if(get_option('oceny_global_f'))		delete_option('oceny_global_f');
		if(get_option('oceny_global_g'))		delete_option('oceny_global_g');
		if(get_option('oceny_global_h'))		delete_option('oceny_global_h');
		if(get_option('oceny_global_i'))		delete_option('oceny_global_i');
		
		if(get_option('oceny_ver'))				delete_option('oceny_ver');
		if(get_option('oceny_wpsupercache'))	delete_option('oceny_wpsupercache');
		if(get_option('oceny_indashboard'))		delete_option('oceny_indashboard');
		if(get_option('oceny_inadmin'))			delete_option('oceny_inadmin');
		if(get_option('oceny_wplink'))			delete_option('oceny_wplink');
		if(get_option('oceny_global'))			delete_option('oceny_global');
		
		$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'oceny_indywidualne' OR meta_key = 'oceny_post' OR meta_key = 'oceny_inpost'");
		$wpdb->query("DROP TABLE $arkusz");
		}

	if(get_option('oceny')=="yes" || get_option('oceny_ver')!="")
		{
		global $wpdb, $arkusz, $wersja;
		if(!get_option('oceny_ver'))
      {
      echo '<div id="message" class="updated fade"><p style="line-height: 19px;">Konfigurator wykrył, że dokonałeś właśnie aktualizacji wtyczki <strong>WP Oceny</strong>. Ze względu na liczne zmiany w kodzie zaleca się odinstalowanie wtyczki poprzez przycisk <strong>"Usuń wszystkie ustawienia"</strong> znajdujący się na dole tej strony, a następnie ponowne jej zainstalowanie.</p></div>';
      }
    else
      {
      $stara_wersja = get_option('oceny_ver');
      if(version_compare($stara_wersja, "0.7.0", "<")) echo '<div id="message" class="updated fade"><p style="line-height: 19px;">Konfigurator wykrył, że właśnie dokonałeś aktualizacji wtyczki <strong>WP Oceny</strong>. Aby wszystkie nowe funkcje zawarte w nowej wersji działały prawidłowo, wymagane jest ponowne zapisanie konfiguracji (wystarczy, że klikniesz przycisk <strong>"Zapisz ustawienia"</strong> bez wprowadzania jakichkolwiek zmian w ustawieniach wtyczki).</p></div>';
      }
		?>
		<form action="" method="post" id="konfigurator_ocen">
			
			<h4>Użytkowanie</h4>
			<ul style="margin: 0 0 20px 20px;">
				<li style="margin-bottom: 20px;"><p><strong>&lt;?php wyswietl_oceny(); ?&gt;</strong> - wstaw ten kod w mejscu, w którym chcesz wyświetlić przyciski służące do głosowania.</p></li>
				<li style="margin-bottom: 20px;"><p><strong>&lt;?php wyswietl_ocene(); ?&gt;</strong> - aby wyświetlić średnią ocenę danego posta, użyj tego kodu.</p></li>
				<li><p style="line-height: 20px;"><strong>&lt;?php wyswietl_naj(<span style="color: #888;">ile</span>, "<span style="color: #888;">ocena</span>"); ?&gt;</strong> - jest to złożona funckja pozwalająca wyświetlić listę postów, które uzyskały największą ilość głosów w danej ocenie. W miejsce <i>"ocena"</i> należy wstawić nazwę oceny (bez polskich znaków) wg której chcemy posortować posty, a w miejsce <i>"ile"</i> ilość pozycji, które chcemy wyswietlić. Przykładowo chcąc wyświetlić listę 10 postów najwyżej ocenionych w kategorii <i>"inspirujące"</i> należy w szablon bloga wstawić kod <i>&lt;?php wyswietl_naj(10, "inspirujace"); ?&gt;</i></p>
				<p style="line-height: 19px;">Funkcję można też wywołać nie podając drugiego parametru (nazwy oceny). Wtedy zostanie zwrócona lista postów, które ogólnie zostały najwyżej ocenione przez użytkowników (średnia ocena jest obliczana ze stosunku głosów pozytywnych do negatywnych). Przykładowe wywołanie funkcji wyświetlającej najlepiej oceniane posty może wyglądać następująco: <i>&lt;?php wyswietl_naj(15); ?&gt;</i></p></li>
			</ul>
			
			<p style="margin: 0 0 40px 20px;">Dodatkowo możesz użyć funkcji <strong>pobierz_ocene()</strong>, aby pobrać ocenę w formacie <b>Xz</b> (np <b>4p</b> zamiast <b>4+</b>, czy <b>3m</b> zamiast <b>3-</b>) i wykorzystać ją w swoich skryptach.</p>
			
			<h4>Ustawienia</h4>
			<?php if(function_exists('wp_cache_post_change'))
				{ ?><p style='margin: 12px 0 5px 20px;'><input type='checkbox' name='oceny_wpsupercache' id='oceny_wpsupercache' value='on'<?php if(get_option('oceny_wpsupercache')=='on') echo ' CHECKED'; ?> /> Aktualizuj automatycznie <strong>cache</strong> wtyczki <strong>WP Super Cache</strong> po oddaniu głosu przez użytkownika</p><?php } ?>

			<p style='margin: 12px 0 5px 20px;'><input type='checkbox' name='oceny_wplink' id='oceny_wplink' value='on'<?php if(get_option('oceny_wplink')!='off') echo ' CHECKED'; ?> /> Wyświetlaj logo <strong>WP-Oceny</strong> po lewej stronie ocen (będę wdzięczny za pozostawienie tej opcji aktywnej)</p>
			<p style='margin: 12px 0 5px 20px;'><input type='checkbox' name='oceny_indashboard' id='oceny_indashboard' value='on'<?php if(get_option('oceny_indashboard')=='on') echo ' CHECKED'; ?> /> Wyświetlaj podsumowanie głosów w <a href="/wp-admin/index.php">dashboardzie</a></p>
			<p style='margin: 12px 0 40px 20px;'><input type='checkbox' name='oceny_inadmin' id='oceny_inadmin' value='on'<?php if(get_option('oceny_inadmin')=='on') echo ' CHECKED'; ?> /> Wyświetlaj oceny poszczególnych postów w <a href="/wp-admin/edit.php">panelu administratora</a></p>
	
			<h4>Wyświetlanie ocen</h4>
			<p style="margin-left: 20px;">Wybierz oceny, które mają być domyślnie wyświetlane na Twoim blogu:</p>
			
			<div style="margin-left: 50px;">
				<?php $oceny_global = get_option('oceny_global');?>
				<p><input type="checkbox" name="global_a" id="global_a" value="on"<?php if($oceny_global[0]==="1") echo ' CHECKED' ?> /><label for="global_a"> Fajne</label></p>
				<p><input type="checkbox" name="global_b" id="global_b" value="on"<?php if($oceny_global[1]==="1") echo ' CHECKED' ?> /><label for="global_b"> Inspirujące</label></p>
				<p><input type="checkbox" name="global_c" id="global_c" value="on"<?php if($oceny_global[2]==="1") echo ' CHECKED' ?> /><label for="global_c"> Piękne</label></p>
				<p><input type="checkbox" name="global_d" id="global_d" value="on"<?php if($oceny_global[3]==="1") echo ' CHECKED' ?> /><label for="global_d"> Śmieszne</label></p>
				<p><input type="checkbox" name="global_e" id="global_e" value="on"<?php if($oceny_global[4]==="1") echo ' CHECKED' ?> /><label for="global_e"> Przydatne</label></p>
				<p><input type="checkbox" name="global_f" id="global_f" value="on"<?php if($oceny_global[5]==="1") echo ' CHECKED' ?> /><label for="global_f"> Szokujące</label></p>
				<p><input type="checkbox" name="global_g" id="global_g" value="on"<?php if($oceny_global[6]==="1") echo ' CHECKED' ?> /><label for="global_g"> Odkrywcze</label></p>
				<p><input type="checkbox" name="global_h" id="global_h" value="on"<?php if($oceny_global[7]==="1") echo ' CHECKED' ?> /><label for="global_h"> Ciekawe</label></p>
				<p><input type="checkbox" name="global_i" id="global_i" value="on"<?php if($oceny_global[8]==="1") echo ' CHECKED' ?> /><label for="global_i"> Kosz</label></p>
			</div>
			
			<p style="margin-left: 20px;"><strong>Info: </strong>Dla każdego z postów (podczas redagowania lub edycji) można wybrać indywidualny zestaw ocen.</p>
			
			<p class="submit"><input type="submit" name="zapisz" value="Zapisz ustawienia" /> <input type="submit" name="usun" value="Usuń wszystkie ustawienia" /> (zostaną usunięte także informacje o oddanych głosach)</p> 
		</form>
		<?php }
	else
		{?>
		<form action="" method="post" id="instalator_ocen"> 
			<p>Do działania wtyczki niezbędne jest utworzenie dodatkowej tabeli w bazie danych. Kliknij przycisk <strong>"Zainstaluj wtyczkę"</strong>, aby utworzyć ją automatycznie.</p>
			<p class="submit"><input type="submit" name="zainstaluj" value="Zainstaluj wtyczkę" /></p> 
		</form>
		<?php }
		
	echo '</div>';
	}

function nowy_post($post_ID)
	{
	global $wpdb, $arkusz;
	$wpdb->query("INSERT $arkusz VALUE('', '$post_ID', '', '', '', '', '', '', '', '', '', '', '','bo')");
	}

function usun_post($post_ID)
	{
	global $wpdb, $arkusz;
	$wpdb->query("DELETE FROM $arkusz WHERE `post_id` = '$post_ID'");
	}

function init_oceny()
	{
	if(is_single())
		{
		global $wersja;
		$baza = get_option('home');
		print "\n\n<!-- WP Oceny-->\n";
		print "<link rel='stylesheet' href='$baza/wp-content/plugins/wp-oceny/oceny.css?ver=".$wersja."' type='text/css' media='screen' />\n";
		print "<script type='text/javascript' src='$baza/wp-content/plugins/wp-oceny/oceny.ajax.js?ver=".$wersja."'></script>\n";
		print "<!-- /WP Oceny -->\n\n";
		}
	}

function wyswietl_oceny()
	{
	if(is_single())
		{
		global $wpdb, $arkusz;
		$gID = get_the_ID();
		$baza = get_option('home');
		$ciacho = $_COOKIE['wp-oceny'];

		$oceny_inpost = get_post_meta($gID, "oceny_inpost", true);

		if($oceny_inpost[9]!=="1")
			{
			$ocena = $wpdb->get_row("SELECT * FROM $arkusz WHERE `post_id` LIKE $gID");

			print "
			<script type='text/javascript'>
			function DodajGlos(ocena)
				{
				var req = mint.Request(ocena);
				req.Send('$baza/wp-content/plugins/wp-oceny/oceny.ajax.php?&co=dodaj&nid=$gID&glos='+ocena, 'oceny');
				$('a').down().onclick = null;
				$('b').down().onclick = null;
				$('c').down().onclick = null;
				$('d').down().onclick = null;
				$('e').down().onclick = null;
				$('f').down().onclick = null;
				$('g').down().onclick = null;
				$('h').down().onclick = null;
				$('i').down().onclick = null;
				}

			function CofnijGlos(ocena)
				{
				var req = mint.Request(ocena);
				req.Send('$baza/wp-content/plugins/wp-oceny/oceny.ajax.php?&co=cofnij&nid=$gID&glos='+ocena, 'oceny');
				$('a').down().onclick = null;
				$('b').down().onclick = null;
				$('c').down().onclick = null;
				$('d').down().onclick = null;
				$('e').down().onclick = null;
				$('f').down().onclick = null;
				$('g').down().onclick = null;
				$('h').down().onclick = null;
				$('i').down().onclick = null;
				}
			</script>";
		
			echo "<div id='oceny'>";

			if($oceny_inpost[10]==="1")		$oceny_global = $oceny_inpost;
			else							$oceny_global = get_option("oceny_global");

			if(get_option('oceny_wplink')!='off') echo '<div class="w"><a href="http://wiecek.biz/projekty/wordpress/wp-oceny" title="WP Oceny"><img src="/wp-content/plugins/wp-oceny/img/w.png" alt="WP Oceny" /></a></div>';
			
			if($oceny_global[0]==="1")
				{
				if(!strstr($ciacho,$gID."a"))	{echo '<div id="a" class="oceny_id"><div class="a" onclick="DodajGlos(\'a\')">'.$ocena->a.'</div></div>';}
				else							{echo '<div id="a" class="oceny_id"><div class="a_k" onclick="CofnijGlos(\'a\')">'.$ocena->a.'</div></div>';}
				}

			if($oceny_global[1]==="1")
				{
				if(!strstr($ciacho,$gID."b"))	{echo '<div id="b" class="oceny_id"><div class="b" onclick="DodajGlos(\'b\')">'.$ocena->b.'</div></div>';}
				else							{echo '<div id="b" class="oceny_id"><div class="b_k" onclick="CofnijGlos(\'b\')">'.$ocena->b.'</div></div>';}
				}

			if($oceny_global[2]==="1")
				{
				if(!strstr($ciacho,$gID."c"))	{echo '<div id="c" class="oceny_id"><div class="c" onclick="DodajGlos(\'c\')">'.$ocena->c.'</div></div>';}
				else							{echo '<div id="c" class="oceny_id"><div class="c_k" onclick="CofnijGlos(\'c\')">'.$ocena->c.'</div></div>';}
				}

			if($oceny_global[3]==="1")
				{
				if(!strstr($ciacho,$gID."d"))	{echo '<div id="d" class="oceny_id"><div class="d" onclick="DodajGlos(\'d\')">'.$ocena->d.'</div></div>';}
				else							{echo '<div id="d" class="oceny_id"><div class="d_k" onclick="CofnijGlos(\'d\')">'.$ocena->d.'</div></div>';}
				}

			if($oceny_global[4]==="1")
				{
				if(!strstr($ciacho,$gID."e"))	{echo '<div id="e" class="oceny_id"><div class="e" onclick="DodajGlos(\'e\')">'.$ocena->e.'</div></div>';}
				else							{echo '<div id="e" class="oceny_id"><div class="e_k" onclick="CofnijGlos(\'e\')">'.$ocena->e.'</div></div>';}
				}

			if($oceny_global[5]==="1")
				{
				if(!strstr($ciacho,$gID."f"))	{echo '<div id="f" class="oceny_id"><div class="f" onclick="DodajGlos(\'f\')">'.$ocena->f.'</div></div>';}
				else							{echo '<div id="f" class="oceny_id"><div class="f_k" onclick="CofnijGlos(\'f\')">'.$ocena->f.'</div></div>';}
				}

			if($oceny_global[6]==="1")
				{
				if(!strstr($ciacho,$gID."g"))	{echo '<div id="g" class="oceny_id"><div class="g" onclick="DodajGlos(\'g\')">'.$ocena->g.'</div></div>';}
				else							{echo '<div id="g" class="oceny_id"><div class="g_k" onclick="CofnijGlos(\'g\')">'.$ocena->g.'</div></div>';}
				}

			if($oceny_global[7]==="1")
				{
				if(!strstr($ciacho,$gID."h"))	{echo '<div id="h" class="oceny_id"><div class="h" onclick="DodajGlos(\'h\')">'.$ocena->h.'</div></div>';}
				else							{echo '<div id="h" class="oceny_id"><div class="h_k" onclick="CofnijGlos(\'h\')">'.$ocena->h.'</div></div>';}
				}

			if($oceny_global[8]==="1")
				{
				if(!strstr($ciacho,$gID."i"))	{echo '<div id="i" class="oceny_id"><div class="i" onclick="DodajGlos(\'i\')">'.$ocena->i.'</div></div>';}
				else							{echo '<div id="i" class="oceny_id"><div class="i_k" onclick="CofnijGlos(\'i\')">'.$ocena->i.'</div></div>';}
				}

			echo "<div style='clear:both;'/></div>
			</div>";
			}
		}
	}

function pobierz_ocene()
	{
	global $wpdb, $arkusz;
	$ocena = $wpdb->get_row("SELECT post_id, so FROM $arkusz WHERE `post_id` = ".get_the_ID());
	return $ocena->so;
	}

function odkoduj_ocene($so)
	{
	switch($so)
		{
		case 'bo':	$socena = '-';	break;
		case '1w':	$socena = '1!';	break;
		case '1':	$socena = '1';	break;
		case '2m':	$socena = '2-';	break;
		case '2':	$socena = '2';	break;
		case '2p':	$socena = '2+';	break;
		case '3m':	$socena = '3-';	break;
		case '3':	$socena = '3';	break;
		case '3p':	$socena = '3+';	break;
		case '4m':	$socena = '4-';	break;
		case '4':	$socena = '4';	break;
		case '4p':	$socena = '4+';	break;
		case '5m':	$socena = '5-';	break;
		case '5':	$socena = '5';	break;
		case '5p':	$socena = '5+';	break;
		case '6':	$socena = '6';	break;
		}
	echo $socena;
	}

function wyswietl_ocene()
	{
	global $wpdb, $arkusz;
	$ocena = $wpdb->get_row("SELECT post_id, so FROM $arkusz WHERE `post_id` = ".get_the_ID());
	echo odkoduj_ocene($ocena->so);
	}

function wyswietl_naj($ile = 10, $co = null)
	{
	global $wpdb, $arkusz;

	switch($co)
		{
		case 'fajne':		$ocena = 'a';	break;
		case 'inspirujace':	$ocena = 'b';	break;
		case 'piekne':		$ocena = 'c';	break;
		case 'smieszne':	$ocena = 'd';	break;
		case 'przydatne':	$ocena = 'e';	break;
		case 'szokujace':	$ocena = 'f';	break;
		case 'odkrywcze':	$ocena = 'g';	break;
		case 'ciekawe':		$ocena = 'h';	break;
		case 'kosz':		$ocena = 'i';	break;
		}

	echo "<ul id='oceny-".$co."'>";

	if($co!=null)	$naje = $wpdb->get_results("SELECT * FROM $arkusz LEFT JOIN $wpdb->posts ON ($arkusz.post_id = $wpdb->posts.ID) WHERE $ocena >= 1 ORDER BY $ocena DESC LIMIT 0,$ile");
	else			$naje = $wpdb->get_results("SELECT * FROM $arkusz LEFT JOIN $wpdb->posts ON ($arkusz.post_id = $wpdb->posts.ID) WHERE so != 'bo' ORDER BY field(so, '6', '5p', '5', '5m', '4p', '4', '4m', '3p', '3', '3m', '2p', '2', '2m', '1p', '1', '1w') LIMIT 0,$ile");

	foreach ($naje as $naj)
		{
		if($co!=null)	echo "<li><a href='".get_permalink($naj->post_id)."' title='".$naj->post_title." (głosów: ".$naj->$ocena.")'>".$naj->post_title."</a> (głosów: ".$naj->$ocena.")</li>";
		else			echo "<li><a href='".get_permalink($naj->post_id)."' title='".$naj->post_title." (średnia ocena: ".$naj->so.")'>".$naj->post_title."</a> (średnia ocena: ".$naj->so.")</li>";
		}
	echo "</ul>";
	}

function oceny_column($defaults)
	{
	$defaults['ocena'] = __('Ocena');
	return $defaults;
	}

function oceny_column_in($column_name, $id)
	{
	if($column_name=='ocena')
		{
		global $wpdb, $arkusz;
		$ocena = $wpdb->get_row("SELECT post_id, so FROM $arkusz WHERE `post_id` = ".$id);
		odkoduj_ocene($ocena->so);
		}
	}

function oceny_head()
	{
	global $wersja;
	$baza = get_option('home');
	print "\n\n<!-- WP Oceny-->\n";
	print "<link rel='stylesheet' href='$baza/wp-content/plugins/wp-oceny/oceny.admin.css?ver=".$wersja."' type='text/css' media='screen' />\n";
	print "<!-- /WP Oceny -->\n\n";
	}

function oceny_menu()
	{
	add_submenu_page('options-general.php', 'WP Oceny', 'WP Oceny', 8, __FILE__, 'oceny_ustawienia');
	}

function oceny_add_meta_tags_textinput() 
	{
	global $post;
	$post_id = $post;
	if(is_object($post_id))
		{
		$post_id = $post_id->ID;
		}
	
	?>
	<div id='advanced-sortables' class='meta-box-sortables'> 
		<div id="adv-tagsdiv" class="postbox closed"> 
			<div class="handlediv" title="Kliknij aby przełączyć"><br /></div><h3 class='hndle'><span>WP Oceny</span></h3>
			<div class="inside">
				<div id="postaiosp">

					<?php $oceny_inpost = get_post_meta($post_id, 'oceny_inpost', true);?>

					<p><input type="checkbox" name="oceny_inpost" id="oceny_inpost" value="on"<?php if($oceny_inpost[9]==="1") echo ' CHECKED' ?> /><label for="oceny_inpost"><strong> Wyłącz możliwość oceniania tego postu.</strong></label></p>

					<p><input type="checkbox" name="oceny_post" id="oceny_post" value="on"<?php if($oceny_inpost[10]==="1") echo ' CHECKED' ?> /><label for="oceny_post"><strong> Użyj indywidualnego zestawu ocen dla tego postu:</strong></label></p>

					<div style="margin: 15px 0 15px 30px;">
						<p><input type="checkbox" name="oceny_post_a" id="oceny_post_a" value="on"<?php if($oceny_inpost[0]==="1") echo ' CHECKED' ?> /><label for="oceny_post_a"> Fajne</label></p>
						<p><input type="checkbox" name="oceny_post_b" id="oceny_post_b" value="on"<?php if($oceny_inpost[1]==="1") echo ' CHECKED' ?> /><label for="oceny_post_b"> Inspirujące</label></p>
						<p><input type="checkbox" name="oceny_post_c" id="oceny_post_c" value="on"<?php if($oceny_inpost[2]==="1") echo ' CHECKED' ?> /><label for="oceny_post_c"> Piękne</label></p>
						<p><input type="checkbox" name="oceny_post_d" id="oceny_post_d" value="on"<?php if($oceny_inpost[3]==="1") echo ' CHECKED' ?> /><label for="oceny_post_d"> Śmieszne</label></p>
						<p><input type="checkbox" name="oceny_post_e" id="oceny_post_e" value="on"<?php if($oceny_inpost[4]==="1") echo ' CHECKED' ?> /><label for="oceny_post_e"> Przydatne</label></p>
						<p><input type="checkbox" name="oceny_post_f" id="oceny_post_f" value="on"<?php if($oceny_inpost[5]==="1") echo ' CHECKED' ?> /><label for="oceny_post_f"> Szokujące</label></p>
						<p><input type="checkbox" name="oceny_post_g" id="oceny_post_g" value="on"<?php if($oceny_inpost[6]==="1") echo ' CHECKED' ?> /><label for="oceny_post_g"> Odkrywcze</label></p>
						<p><input type="checkbox" name="oceny_post_h" id="oceny_post_h" value="on"<?php if($oceny_inpost[7]==="1") echo ' CHECKED' ?> /><label for="oceny_post_h"> Ciekawe</label></p>
						<p><input type="checkbox" name="oceny_post_i" id="oceny_post_i" value="on"<?php if($oceny_inpost[8]==="1") echo ' CHECKED' ?> /><label for="oceny_post_i"> Kosz</label></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	}

function oceny_post_meta_tags($pID)
	{
	if($_POST['oceny_post_a']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_b']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_c']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_d']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_e']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_f']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_g']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_h']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post_i']=='on') 	$oceny_inpost .= "1"; else $oceny_inpost .= "0";

	if($_POST['oceny_inpost']=='on')	$oceny_inpost .= "1"; else $oceny_inpost .= "0";
	if($_POST['oceny_post']=='on')		$oceny_inpost .= "1"; else $oceny_inpost .= "0";

	if(get_post_meta($pID, 'oceny_inpost'))	{update_post_meta($pID, 'oceny_inpost', $oceny_inpost);}
	else									{add_post_meta($pID, 'oceny_inpost', $oceny_inpost, true);}
	}

if(get_option('oceny_inadmin')=='on')
	{
	add_filter('manage_posts_columns', 'oceny_column');
	add_action('manage_posts_custom_column', 'oceny_column_in', 10, 2);
	}


function OcenyWidgetFunction()
	{
	global $wpdb, $arkusz;
	$oceny_suma = $wpdb->get_results("SELECT * FROM ".$arkusz);
	foreach ($oceny_suma as $os)
		{
		$a = $a+$os->a;
		$b = $b+$os->b;
		$c = $c+$os->c;
		$d = $d+$os->d;
		$e = $e+$os->e;
		$f = $f+$os->f;
		$g = $g+$os->g;
		$h = $h+$os->h;
		$i = $i+$os->i;
		}

	?>
	<script type='text/javascript'>
		function PokazNajlepsze(ocena)
			{
			var req = mint.Request(ocena);
			req.Send('<?php echo get_option('home'); ?>/wp-content/plugins/wp-oceny/oceny.ajax.php?&co=pokaz&glos='+ocena, 'najlepsze_oceny');
			}
	</script>
	<?php
	$oceny_global = get_option("oceny_global");
	
	$last = explode(",", get_option("oceny_last"));
	
	if($a>$last[0] && get_option("oceny_last")) {$roznicaa = $a-$last[0]; $ra = "<span>+".$roznicaa."</span>";}
	if($b>$last[1] && get_option("oceny_last")) {$roznicab = $b-$last[1]; $rb = "<span>+".$roznicab."</span>";}
	if($c>$last[2] && get_option("oceny_last")) {$roznicac = $c-$last[2]; $rc = "<span>+".$roznicac."</span>";}
	if($d>$last[3] && get_option("oceny_last")) {$roznicad = $d-$last[3]; $rd = "<span>+".$roznicad."</span>";}
	if($e>$last[4] && get_option("oceny_last")) {$roznicae = $e-$last[4]; $re = "<span>+".$roznicae."</span>";}
	if($r>$last[5] && get_option("oceny_last")) {$roznicaf = $f-$last[5]; $rf = "<span>+".$roznicaf."</span>";}
	if($g>$last[6] && get_option("oceny_last")) {$roznicag = $g-$last[6]; $rg = "<span>+".$roznicag."</span>";}
	if($h>$last[7] && get_option("oceny_last")) {$roznicah = $h-$last[7]; $rh = "<span>+".$roznicah."</span>";}
	if($i>$last[8] && get_option("oceny_last")) {$roznicai = $i-$last[8]; $ri = "<span>+".$roznicai."</span>";}
	
	if(get_option("oceny_last"))	update_option("oceny_last", $a.",".$b.",".$c.",".$d.",".$e.",".$f.",".$g.",".$h.",".$i);
	else							add_option("oceny_last", $a.",".$b.",".$c.",".$d.",".$e.",".$f.",".$g.",".$h.",".$i, " ", "no");
	
	echo "<div id='oceny-da' style='margin: 0; padding: 0;'>";
	
	if($oceny_global[0]==="1")	echo "<div class='oceny_id'><div class='a_pa' onclick='PokazNajlepsze(\"a\")'>".$a.$ra."</div></div>";
	if($oceny_global[1]==="1")	echo "<div class='oceny_id'><div class='b_pa' onclick='PokazNajlepsze(\"b\")'>".$b.$rb."</div></div>";
	if($oceny_global[2]==="1")	echo "<div class='oceny_id'><div class='c_pa' onclick='PokazNajlepsze(\"c\")'>".$c.$rc."</div></div>";
	if($oceny_global[3]==="1")	echo "<div class='oceny_id'><div class='d_pa' onclick='PokazNajlepsze(\"d\")'>".$d.$rd."</div></div>";
	if($oceny_global[4]==="1")	echo "<div class='oceny_id'><div class='e_pa' onclick='PokazNajlepsze(\"e\")'>".$e.$re."</div></div>";
	if($oceny_global[5]==="1")	echo "<div class='oceny_id'><div class='f_pa' onclick='PokazNajlepsze(\"f\")'>".$f.$rf."</div></div>";
	if($oceny_global[6]==="1")	echo "<div class='oceny_id'><div class='g_pa' onclick='PokazNajlepsze(\"g\")'>".$g.$rg."</div></div>";
	if($oceny_global[7]==="1")	echo "<div class='oceny_id'><div class='h_pa' onclick='PokazNajlepsze(\"h\")'>".$h.$rh."</div></div>";
	if($oceny_global[8]==="1")	echo "<div class='oceny_id'><div class='i_pa' onclick='PokazNajlepsze(\"i\")'>".$i.$ri."</div></div>";
	
	echo "<div style='clear:both;'/></div></div>
	<div id='najlepsze_oceny' style='margin: 10px 0 20px 10px;'><p><strong>Porada: </strong>kliknij na jedną z ikon, aby zobaczyć listę postów, które zdobyły najwięcej głosów w danej ocenie.</p></div>";
	} 

function OcenyAddDashboardWidgets()
	{
	wp_add_dashboard_widget('WPOcenyWidget', 'WP Oceny', 'OcenyWidgetFunction');	
	} 

if(get_option('oceny_indashboard')=="on")
	{
	add_action('wp_dashboard_setup', 'OcenyAddDashboardWidgets');
	}

add_action('edit_form_advanced', 'oceny_add_meta_tags_textinput');
add_action('edit_page_form', 'oceny_add_meta_tags_textinput');

add_action('edit_post', 'oceny_post_meta_tags');
add_action('publish_post', 'oceny_post_meta_tags');
add_action('save_post', 'oceny_post_meta_tags');
add_action('edit_page_form', 'oceny_post_meta_tags');

add_action('admin_head', 'oceny_head');
add_action('wp_head', 'init_oceny');
add_action('publish_post','nowy_post');
add_action('delete_post','usun_post');
add_action('admin_menu', 'oceny_menu');
?>