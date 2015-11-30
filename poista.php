<?php
	$pageName = "Poista sivu / uutinen";
	require_once("artikkeli.php");
	
	if(isset($_POST['poista'])) {
		$id = $_POST['poista'];
		try {
			require_once("artikkeliPDO.php");
			$dbactions = new artikkeliPDO();
			$dbactions->poistaArtikkeli($id);
		} catch (Exception $error) {
			print($error->getMessage());
		}
	}
?>

<?php require("top.php"); ?>
	<form name="poistolomake" action="#" method="post">
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
                
                <td>Poista</td>
                
             </tr>
             
          </thead>
       
    
    	<?php
			foreach($artikkelit as $artikkeli) {
				if($artikkeli[0]->getTyyppi() == "sivu" || $artikkeli[0]->getTyyppi() == "Sivu") {
					print("<tr>");
					print("<td>" . $artikkeli[1] . "</td>"); // Artikkelin id
					print("<td>" . $artikkeli[0]->getOtsikko() . "</td>");
					print("<td><button type=\"submit\" value=\"" . $artikkeli[1] . "\" name=\"poista\">Poista</button></td>");
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
                
                	<td>Poista</td>
                    
                 </tr>
                 
              </thead>
           
        
            <?php
                foreach($artikkelit as $artikkeli) {
                    if($artikkeli[0]->getTyyppi() == "uutinen" || $artikkeli[0]->getTyyppi() == "Uutinen") {
                        print("<tr>");
						print("<td>" . $artikkeli[1] . "</td>"); // Artikkelin id
                        print("<td>" . $artikkeli[0]->getOtsikko() . "</td>");
						print("<td><button type=\"submit\" value=\"" . $artikkeli[1] . "\" name=\"poista\">Poista</button></td>");
                        print("</tr>");
                    }
                }
            ?>
            
            </table>
    </form>
    
    
        
<?php require("bot.php"); ?>