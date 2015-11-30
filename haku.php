<?php
	$pageName = "Hae sivuista / uutisista";
?>

<?php require("top.php"); ?>

	<form action="#" method="post" name="hakulomake" class="vt">
    
    	<label for="haenimella" style="float: left;">Hae artikkelin nimellä:</label>
        <input type="text" name="haenimella" value="<?php if(isset($_POST['haenimella'])) print($_POST['haenimella']);?>" id="haenimella" style="float: left;">
        <input type="submit" name="hae" value="hae" style="float: left;">
       <div style="clear: both;"></div>
    </form>
    
    <?php
	
		if(isset($_POST['hae'])) {
			if(strlen($_POST['haenimella']) > 2) {
				require_once("artikkeli.php");
				require_once("artikkelipdo.php");
				$txt = $_POST['haenimella'];
				$dbactions = new artikkeliPDO();
				$artikkelit = $dbactions->haeArtikkelit($txt);
				if(empty($artikkelit)) {
					print("<p>Hakutuloksella ei löytynyt osumia</p>");
				} else {
					foreach($artikkelit as $artikkeli) {
						print("<p>Tyyppi: " . $artikkeli[0]->getTyyppi() . "</p>");
						print("<p>Otsikko: " . $artikkeli[0]->getOtsikko() . "</p>");
						print("<p>Alaotsikko: " . $artikkeli[0]->getAlaotsikko() . "</p>");
						print("<br>");
					}
				}
			} else {
				print("<p>Hakutermin tulee olla vähintään 3 merkin pituinen</p>");
			}
		}
	
	?>
    
    
        
<?php require("bot.php"); ?>