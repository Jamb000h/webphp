<?php
	// Sivun muuttujat
	$pageName = "Etusivu";
?>

<?php require("top.php"); ?>

			<br>
            
            <?php if(isset($_COOKIE['nimi'])) {
				echo "<p>Tervetuloa JonneCMS:ään, " . $_COOKIE['nimi'] . "!";
			} else { ?>
            <p>Tervetuloa JonneCMS:ään - simppeliin tapaan hallinnoida omaa sivustoasi!</p>
			<?php 
			} ?>
            
<?php require("bot.php"); ?>