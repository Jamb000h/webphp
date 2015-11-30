<?php
	require_once("artikkeli.php");
	$pageName = "Näytä sivut / Uutiset";
?>

<?php require("top.php"); ?>

	<?php
	
		try {
			require_once("artikkeliPDO.php");
			$dbactions = new artikkeliPDO();
			$artikkelit = $dbactions->kaikkiArtikkelit();
		} catch (Exception $error) {
			print($error->getMessage());
		}
	
	?>
    <br>
    <h3>Sivut</h3>
    
    	<br>
    
    	<table>
        
        <thead>
        
        	<tr>
            
            	<td>Id</td>
                
                <td>Otsikko</td>
                
                <td>Alaotsikko</td>
                
                <td>Teksti</td>
                
                <td>Kirjoittaja</td>
                
                <td>Pvm</td>
                
             </tr>
             
          </thead>
       
    
    	<?php
			foreach($artikkelit as $artikkeli) {
				if($artikkeli[0]->getTyyppi() == "sivu" || $artikkeli[0]->getTyyppi() == "Sivu") {
					print("<tr>");
					print("<td>" . $artikkeli[1] . "</td>"); // Artikkelin id
					print("<td>" . $artikkeli[0]->getOtsikko() . "</td>");
					print("<td>" . $artikkeli[0]->getAlaotsikko() . "</td>");
					print("<td>" . $artikkeli[0]->getTeksti() . "</td>");
					print("<td>" . $artikkeli[0]->getKirjoittaja() . "</td>");
					print("<td>" . $artikkeli[0]->getPvm() . "</td>");
					print("</tr>");
				}
			}
		?>
		</table>
    <br>
    <br>
    <h3>Uutiset</h3>
    
        <table>
            
            <thead>
            
                <tr>
                
                	<td>Id</td>
                    
                    <td>Otsikko</td>
                    
                    <td>Alaotsikko</td>
                    
                    <td>Teksti</td>
                    
                    <td>Kirjoittaja</td>
                    
                    <td>Pvm</td>
                    
                 </tr>
                 
              </thead>
           
        
            <?php
                foreach($artikkelit as $artikkeli) {
                    if($artikkeli[0]->getTyyppi() == "uutinen" || $artikkeli[0]->getTyyppi() == "Uutinen") {
                        print("<tr>");
						print("<td>" . $artikkeli[1] . "</td>"); // Artikkelin id
                        print("<td>" . $artikkeli[0]->getOtsikko() . "</td>");
                        print("<td>" . $artikkeli[0]->getAlaotsikko() . "</td>");
                        print("<td>" . $artikkeli[0]->getTeksti() . "</td>");
                        print("<td>" . $artikkeli[0]->getKirjoittaja() . "</td>");
                        print("<td>" . $artikkeli[0]->getPvm() . "</td>");
                        print("</tr>");
                    }
                }
            ?>
            
            </table>
          
<?php require("bot.php"); ?>