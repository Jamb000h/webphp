<?php
	require_once("artikkeli.php");
	session_start();
	$pageName = "Vahvista uusi sivu / artikkeli";
	
	if(isset($_SESSION['artikkeli'])) { // Jos artikkeli on talletettu sessiomuuttujaan
		$artikkeli = $_SESSION['artikkeli'];
		
	} else { // Muussa tapauksessa poistutaan sivulta
		header("Location: uusi.php");
		exit();
	}
	
	if(isset($_POST['tallenna'])) {
		try {
			require_once("artikkelipdo.php");
			$dbactions = new artikkeliPDO();
			$dbactions->lisaaArtikkeli($artikkeli);
		} catch (Exception $error) {
			print($error->getMessage());
		}
		// Tyhjennetään sessiomuuttujat
		$_SESSION = array();
		// Tuhotaan sessio
		session_destroy();
		header("Location: tallennettu.php");
		exit();
		
	} else if(isset($_POST['peruuta'])) {
		// Tyhjennetään sessiomuuttujat
		$_SESSION = array();
		// Tuhotaan sessio
		session_destroy();
		// Luodaan Location-tyyppinen header jolla ohjataan takaisin etusivulle
		header("Location: index.php");
		// Pysäytetään skriptin suorittaminen
		exit();
		
	} else if(isset($_POST['korjaa'])) {
		header("Location: uusi.php");
		exit();
	}
	
	session_write_close();
?>

<?php require("top.php"); ?>
   
            <br>
            
            <h3>Uuden sivun / artikkelin tiedot</h3>
            
            <form name="vahvista" action="#" method="post">
            
                <h4>Otsikko:</h4><br>
                
                <p><?php print($artikkeli->getOtsikko());?></p><br>
                
                <h4>Alaotsikko:</h4><br>
                
                <p><?php print($artikkeli->getAlaotsikko());?></p><br>
                
                <h4>Teksti:</h4><br>
                
                <p><?php print($artikkeli->getTeksti());?></p><br>
                
                <h4 class="right">Kirjoittaja:</h4><br>
                
                <p class="right"><?php print($artikkeli->getKirjoittaja());?></p><br><br>
                
                <h4 class="right">Julkaisupäivämäärä:</h4><br>
                
                <p class="right"><?php print($artikkeli->getPvm());?></p><br>

            	<input type="submit" name="korjaa" value="Korjaa">
            
            	<input type="submit" name="tallenna" value="Tallenna">
                
                <input type="submit" name="peruuta" value="Peruuta">
            
            </form>
<?php require("bot.php"); ?>