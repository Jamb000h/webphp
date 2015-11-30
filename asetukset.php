<?php
	$pageName = "Asetukset";
	
	if(isset($_POST['tallenna'])) { // Jos on päätetty tallentaa nimi
		setcookie("nimi", $_POST['nimi'], time() + 60*60*24*7); // Asetetaan nimi-eväste
		header("Location: index.php"); // Siirrytään etusivulle
		exit(); // Lopetetaan skriptin suorittaminen
	}
?>

<?php require("top.php"); ?>

		<form name="asetukset" method="post" action="#" class="vt">
        
        	<label for="nimi">Nimesi:</label>
            
            <input type="text" id="nimi" name="nimi" value="<?php if(isset($_COOKIE['nimi'])) { print($_COOKIE['nimi']); } ?>">
            
     		<input type="submit" name="tallenna" value="Aseta nimi">
        
        </form>
<?php require("bot.php"); ?>