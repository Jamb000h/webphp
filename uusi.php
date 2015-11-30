<?php
	// Sivun omat muuttujat
	$pageName = "Uusi sivu / uutinen";
	
	// Tarvittavat luokat yms.
	
	require_once("artikkeli.php"); // Artikkeli-luokka
	
	session_start();
	
	// Sivun toiminnon valinta ja suoritus
	
	if(isset($_POST["tallenna"])) { // Jos päätetty tallentaa sivu/artikkeli
		// Luodaan Artikkeli-olio annettujen tietojen perusteella
		$artikkeli = new Artikkeli($_POST["tyyppi"], $_POST["otsikko"], $_POST["alaotsikko"], 		$_POST["teksti"], $_POST["kirjoittaja"], $_POST["pvm"]);
		
		// Tarkastetaan olion attribuuttien arvot
		$otsikkoVirhe = $artikkeli->checkOtsikko();
		$alaotsikkoVirhe = $artikkeli->checkAlaotsikko();
		$tekstiVirhe = $artikkeli->checkTeksti();
		$kirjoittajaVirhe = $artikkeli->checkKirjoittaja();
		$pvmVirhe = $artikkeli->checkPvm();
		
		// Lisätään haetut virhekoodit taulukkoon
		$virheet = array($otsikkoVirhe, $alaotsikkoVirhe, $tekstiVirhe, $kirjoittajaVirhe, $pvmVirhe);
		
		// Nollataan muuttuja, johon talletetaan virheiden lukumäärä
		$virheita = 0;
		
		// Käydään läpi haetuista virhekoodeista luotu taulukko
		foreach($virheet as $virhe) {
			if($virhe > 0) {
				$virheita++;
			}
		}
		
		// Jos virheitä ei löytynyt (kaikki virhekoodit == 0) siirrytään vahvistussivulle
		if($virheita == 0) {
			$_SESSION['artikkeli'] = $artikkeli;
			header("Location: vahvista.php");
			exit();
		}
		
	} else if(isset($_POST["peruuta"])) { // Jos päätetty peruuttaa lisääminen
		// Tyhjennetään sessiomuuttujat
		$_SESSION = array();
		// Tuhotaan sessio
		session_destroy();
		// Luodaan Location-tyyppinen header jolla ohjataan takaisin etusivulle
		header("Location: index.php");
		// Pysäytetään skriptin suorittaminen
		exit();
		
	} else if(isset($_SESSION['artikkeli'])) { // Jos artikkeli on talletettu sessiomuuttujaan
		$artikkeli = $_SESSION['artikkeli'];
		// Tarkastetaan olion attribuuttien arvot
		$otsikkoVirhe = $artikkeli->checkOtsikko();
		$alaotsikkoVirhe = $artikkeli->checkAlaotsikko();
		$tekstiVirhe = $artikkeli->checkTeksti();
		$kirjoittajaVirhe = $artikkeli->checkKirjoittaja();
		$pvmVirhe = $artikkeli->checkPvm();
	}
	else { // Muussa tapauksessa
		// Luodaan tyhjä Artikkeli-olio
		$artikkeli = new Artikkeli();
		
		// Asetetaan virhemuuttujien arvoiksi 0, jotta virhetekstin paikalle tulostuu tyhjää
		$otsikkoVirhe = 0;
		$alaotsikkoVirhe = 0;
		$tekstiVirhe = 0;
		$kirjoittajaVirhe = 0;
		$pvmVirhe = 0;
	}
	
	// Suljetaan sessio sivulta koska sitä ei enää tarvita
	session_write_close();
?>

<?php include_once("top.php"); ?>
                
            <form name="uusi" action="#" method="post" class="vt">
            
                <label for="tyyppi">Tyyppi</label><br>
                
                <select id="tyyppi" name="tyyppi">
                
                    <option value="Sivu"<?php if($artikkeli->getTyyppi() == "Sivu") {
						echo " selected"; } ?>>Sivu</option>
                    
                    <option value="Uutinen"<?php if($artikkeli->getTyyppi() == "Uutinen") {
						echo " selected"; } ?>>Uutinen</option>
                
                </select><br><br>
                
                <label for="otsikko">Otsikko</label><br>
                
                <input type="text" id="otsikko" name="otsikko" value="<?php print(htmlentities($artikkeli->getOtsikko(), ENT_QUOTES, "UTF-8"));?>">
                <?php echo("<br><p class=\"error\">" . $artikkeli->getError($otsikkoVirhe) . "</p>") ?><br><br>
                
                <label for="alaotsikko">Alaotsikko</label><br>
                
                <input type="text" id="alaotsikko" name="alaotsikko" value="<?php print(html_entity_decode($artikkeli->getAlaotsikko(), ENT_QUOTES, "UTF-8"));?>">
				<?php echo("<br><p class=\"error\">" . $artikkeli->getError($alaotsikkoVirhe) . "</p>") ?><br><br>
                
                <label for="teksti">Teksti</label><br>
                
                <textarea id="teksti" name="teksti"><?php print(htmlentities($artikkeli->getTeksti(), ENT_QUOTES, "UTF-8"));?></textarea>
                <?php echo("<br><p class=\"error\">" . $artikkeli->getError($tekstiVirhe) . "</p>") ?><br><br>
                
                <label for="kirjoittaja" class="right">Kirjoittaja</label><br>
                
                <input type="text" id="kirjoittaja" name="kirjoittaja" class="right" value="<?php print(htmlentities($artikkeli->getKirjoittaja(), ENT_QUOTES, "UTF-8"));?>">
                <?php echo("<br><p class=\"error right\">" . $artikkeli->getError($kirjoittajaVirhe) . "</p>") ?><br><br>
                
                <label for="pvm" class="right">Julkaisupäivämäärä</label><br>
                
                <input type="text" id="pvm" name="pvm" class="right" value="<?php print(htmlentities($artikkeli->getPvm(), ENT_QUOTES, "UTF-8"));?>">
                <?php echo("<br><p class=\"error right\">" . $artikkeli->getError($pvmVirhe) . "</p>") ?><br><br>
                
                <input type="submit" name="tallenna" value="Tallenna">
                
                <input type="submit" name="peruuta" value="Peruuta">
                
        	</form>
<?php require("bot.php"); ?>