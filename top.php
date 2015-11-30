<?php
	require_once("functions.php");
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">

	<title>JonneCMS | <?php echo $pageName; ?></title>
    
    <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

	<div id="wrapper">
    
    	<header>
        
        	<h1> JonneCMS </h1>
        
        	<nav>
            
            	<ul>
                
                	<li><a href="index.php">Etusivu</a></li>
                    
                    <li><a href="uusi.php">Uusi sivu / uutinen</a></li>
                    
                    <li><a href="listaa.php">Näytä sivut / uutiset</a></li>
                    
                    <li><a href="poista.php">Poista sivu / uutinen</a></li>
                    
                    <li><a href="haku.php">Hae sivuista / uutisista</a></li>
                    
                    <li><a href="asetukset.php">Asetukset</a></li>
                
                </ul>
            
            </nav>
        
        </header>
        
        <section>
        
        	<h2> <?php echo $pageName; ?> </h2>
            