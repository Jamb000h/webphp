<?php

	require_once("functions.php");

	class Artikkeli {
		
		// Virhetaulukko
		private static $virheTaulukko = array (
			0 => "",
			11 => "Sivulla / uutisella täytyy olla otsikko",
			12 => "Otsikon tulee olla vähintään 10 merkkiä pitkä",
			13 => "Otsikko voi olla korkeintaan 50 merkkiä pitkä",
			14 => "Otsikko saa sisältää vain kirjaimia, numeroita, välilyöntejä ja merkkejä .,?!:+_-%",
			21 => "Sivulla / uutisella täytyy olla alaotsikko",
			22 => "Alaotsikko voi olla korkeintaan 50 merkkiä pitkä",
			23 => "Alaotsikko saa sisältää vain kirjaimia, numeroita, välilyöntejä ja merkkejä .,?!:+_-%",
			31 => "Sivulla / uutisella täytyy olla teksti",
			32 => "Teksti on liian lyhyt",
			33 => "Teksti on liian pitkä",
			34 => "Teksti ei saa sisältää muita merkkejä kuin a-ö, 0-9, välilyönti, .,!?-+()[]{}´`\"'*:^_|&amp;%\$£@/=",
			41 => "Sivulla / uutisella täytyy olla kirjoittaja",
			42 => "Kirjoittajan nimi on liian lyhyt",
			43 => "Kirjoittajan nimi on liian pitkä",
			44 => "Kirjoittajan nimessä saa olla vain kirjaimia, numeroita, välilyöntejä ja merkkejä .-",
			51 => "Sivulla / uutisella täytyy olla julkaisupäivämäärä",
			52 => "Päivämäärä on viallinen - kirjoita päivämäärä muodossa vvvv-kk-pp",
			53 => "Päivämäärän tulee olla joko tämä tai jokin mennyt päivä"
		);
		
		// Attribuutit
		private $tyyppi;
		private $otsikko;
		private $alaotsikko;
		private $teksti;
		private $kirjoittaja;
		private $pvm;
		
		// Konstruktori
		function __construct($tyyppi = "", $otsikko = "", $alaotsikko = "", $teksti = "", $kirjoittaja = "", $pvm = "") {
			$this->tyyppi = $tyyppi;
			$this->otsikko = trim($otsikko);
			$this->alaotsikko = trim($alaotsikko);
			$this->teksti = trim($teksti);
			$this->kirjoittaja = trim($kirjoittaja);
			$this->pvm = trim($pvm);
		}
		
		// Metodit

		public function getTyyppi() {
			return $this->tyyppi;
		}
		
		public function setTyyppi($tyyppi) { 
			$this->tyyppi = $tyyppi;
		}
		
		// Ei tarvita, koska tyyppi valitaan valmiiksi määritellyltä listalta
		/*
		public function checkTyyppi() {
			
		}
		*/
		
		public function getOtsikko() { 
			return $this->otsikko;
		}
		
		public function setOtsikko($otsikko) { 
			$this->otsikko = $otsikko;
		}
		
		public function checkOtsikko($required = true, $min = 10, $max = 50) {
			// Pakollisuus
			if(!self::checkRequired($this->otsikko, $required)) {
				return 11;
			}
			
			// Jos liian lyhyt
			if(!self::checkMin($this->otsikko, $min)) {
				return 12;
			}
			
			// Jos liian pitkä
			if(!self::checkMax($this->otsikko, $max)) {
				return 13;
			}
			
			// Jos sisältää muita kuin kirjaimia, numeroita tai yleisiä välimerkkejä
			$regexp = "/^[\wåäö\s\.,?!:+\-%]+$/i";
			if(!preg_match($regexp, $this->otsikko)) {
				return 14;
			}
			
			// Ei virheitä
			return 0;
		}
		
		public function getAlaotsikko() {
			return $this->alaotsikko;
		}
		
		public function setAlaotsikko($alaotsikko) {
			$this->alaotsikko = $alaotsikko;
		}
		
		public function checkAlaotsikko($required = false, $max = 50) {
			// Pakollisuus
			if(!self::checkRequired($this->alaotsikko, $required)) {
				return 21;
			}
			
			// Jos liian pitkä
			if(!self::checkMax($this->alaotsikko, $max)) {
				return 22;
			}
			
			// Jos sisältää muita kuin kirjaimia, numeroita tai yleisiä välimerkkejä
			$regexp = "/^[\wåäö\s\.,?!:+\-%]*$/i";
			if(!preg_match($regexp, $this->alaotsikko)) {
				return 23;
			}
			
			// Ei virheitä
			return 0;
		}
		
		public function getTeksti() {
			return $this->teksti;
		}
		
		public function setTeksti($teksti) {
			$this->teksti = $teksti;
		}
		
		public function checkTeksti($required = true, $min = 30, $max = 5000) {
			// Pakollisuus
			if(!self::checkRequired($this->teksti, $required)) {
				return 31;
			}
			
			// Jos liian lyhyt
			if(!self::checkMin($this->teksti, $min)) {
				return 32;
			}
			
			// Jos liian pitkä
			if(!self::checkMax($this->teksti, $max)) {
				return 33;
			}
			
			// Jos sisältää muita kuin kirjaimia, numeroita tai yleisiä välimerkkejä
			//$regexp = "/^[a-zåäö0-9\.,\!\?\-\+\(\)\[\]\{\}´`'\*\:\^_\\\|&%\$£@/\=\<\>\R\s]$+/i";
			$regexp = "/^[\wåäöÅÄÖ\.\!\?\-\+\(\)\[\]\{\}\"\'\*\:\^\|\$\/\=\R\s_,´`&\;%£@]+$/i";
			if(!preg_match($regexp, $this->teksti)) {
				return 34;
			}
			
			// Ei virheitä
			return 0;
		}
		
		public function getKirjoittaja() {
			return $this->kirjoittaja;
		}
		
		public function setKirjoittaja($kirjoittaja) {
			$this->kirjoittaja = $kirjoittaja;
		}
		
		public function checkKirjoittaja($required = true, $min = 10, $max = 60) {
			// Pakollisuus
			if(!self::checkRequired($this->kirjoittaja, $required)) {
				return 41;
			}
			
			// Jos liian lyhyt
			if(!self::checkMin($this->kirjoittaja, $min)) {
				return 42;
			}
			
			// Jos liian pitkä
			if(!self::checkMax($this->kirjoittaja, $max)) {
				return 43;
			}
			
			// Vain kirjaimet, numerot, välilyönti ja piste sallittu
			$regexp = "/^[a-zåäö0-9\-\.\s]+$/i";
			if(!preg_match($regexp, $this->kirjoittaja)) {
				return 44;
			}
			
			// Ei virheitä
			return 0;
		}
		
		public function getPvm() {
			return $this->pvm;
		}
		
		public function setPvm($pvm) {
			$this->pvm = $pvm;
		}
		
		public function checkPvm($required = true) {
			// Pakollisuus
			if(!self::checkRequired($this->pvm, $required)) {
				return 51;
			}
			
			// Jos ei muodossa vvvv-kk-pp
			$regexp = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
			if(!preg_match($regexp, $this->pvm)) {
				return 52;
			}
			
			// Päivämäärän osien erotteleminen toisistaan
			
			$vuosi = substr($this->pvm, 0, 4);
			$kuukausi = substr($this->pvm, 5, 2);
			$paiva = substr($this->pvm, 8, 2);
			
			if($vuosi > date("Y")) {
				return 53;
			}
			
			if($vuosi == date("Y") && $kuukausi > date("m")) {
				return 53;
			}
			
			if($vuosi == date("Y") && $kuukausi == date("m") && $paiva > date("d")) {
				return 53;
			}
			
			// Ei virheitä
			return 0;
		}
		
		public function checkMin($merkkijono, $min) {
			if(strlen($merkkijono) < $min) {
				return false;
			}
			return true;
		}
		
		public function checkMax($merkkijono, $max) {
			if(strlen($merkkijono) > $max) {
				return false;
			}
			return true;
		}
		
		public function checkRequired($attribuutti, $required) {
			if($required == true && strlen($attribuutti) < 1) {
				return false;
			}
			return true;
		}
		
		public static function getError($virheKoodi) {
			return self::$virheTaulukko[$virheKoodi];
		}
		
}

?>