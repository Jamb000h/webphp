<?php

class artikkeliPDO {
	private $db;
	private $lkm;
	
	function __construct($dsn = "mysql:host=localhost;dbname=a1202419;charset=utf8", $user = "root", $password = "salainen") {
		$this->db = new PDO($dsn, $user, $password);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
		$this->lkm = 0;
	}
	
	function lisaaArtikkeli($artikkeli) {
		$sql = "insert into artikkeli (tyyppi, otsikko, alaotsikko, teksti, kirjoittaja, pvm) values (:tyyppi, :otsikko, :alaotsikko, :teksti, :kirjoittaja, :pvm)";
		
		if(!$stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		$stmt->bindValue(":tyyppi", utf8_decode($artikkeli->getTyyppi()), PDO::PARAM_STR);
		$stmt->bindValue(":otsikko", utf8_decode($artikkeli->getOtsikko()), PDO::PARAM_STR);
		$stmt->bindValue(":alaotsikko", utf8_decode($artikkeli->getAlaotsikko()), PDO::PARAM_STR);
		$stmt->bindValue(":teksti", utf8_decode($artikkeli->getTeksti()), PDO::PARAM_STR);
		$stmt->bindValue(":kirjoittaja", utf8_decode($artikkeli->getKirjoittaja()), PDO::PARAM_STR);
		$stmt->bindValue(":pvm", utf8_decode($artikkeli->getPvm()), PDO::PARAM_STR);
		
		if(!$stmt->execute()) {
			$virhe = $stmt->errorInfo();
			
			if ($virhe[0] == "HY093") {
				$virhe[2] = "Invalid parameter";
			}
			
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		$this->lkm = 1;
		
		return $this->db->lastInsertId();
	}
	
	function poistaArtikkeli($id) {
		$sql = "delete from artikkeli where id = :id";
		if(!$stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		if(!$stmt->execute()) {
			$virhe = $stmt->errorInfo();
			
			if ($virhe[0] == "HY093") {
				$virhe[2] = "Invalid parameter";
			}
			
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		$this->lkm = 1;
		
		return $this->db->lastInsertId();
	}
	
	function haeArtikkelit($txt) {
		$sql = "select * from artikkeli where otsikko like :txt";
		
		if(!$stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		$stmt->bindValue(":txt", "%".$txt."%", PDO::PARAM_STR);
		
		if(!$stmt->execute()) {
			$virhe = $stmt->errorInfo();
			
			if ($virhe[0] == "HY093") {
				$virhe[2] = "Invalid parameter";
			}
			
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		$artikkelit = array();
		
		while($row = $stmt->fetchObject()) {
			$artikkeli = new Artikkeli();
			$artikkeli->setTyyppi($row->tyyppi);
			$artikkeli->setOtsikko($row->otsikko);
			$artikkeli->setAlaotsikko($row->alaotsikko);
			$artikkeli->setTeksti($row->teksti);
			$artikkeli->setKirjoittaja($row->kirjoittaja);
			$artikkeli->setPvm($row->pvm);
			$artikkelit[] = array($artikkeli, $row->id);
		}
		$this->lkm = $stmt->rowCount();
		
		return $artikkelit;
	}
	
	function kaikkiArtikkelit() {
		$sql = "select * from artikkeli";
		
		if(!$stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		if(!$stmt->execute()) {
			$virhe = $stmt->errorInfo();
			
			if ($virhe[0] == "HY093") {
				$virhe[2] = "Invalid parameter";
			}
			
			throw new PDOException($virhe[2], $virhe[1]);
		}
		
		$artikkelit = array();
		
		while($row = $stmt->fetchObject()) {
			$artikkeli = new Artikkeli();
			$artikkeli->setTyyppi($row->tyyppi);
			$artikkeli->setOtsikko($row->otsikko);
			$artikkeli->setAlaotsikko($row->alaotsikko);
			$artikkeli->setTeksti($row->teksti);
			$artikkeli->setKirjoittaja($row->kirjoittaja);
			$artikkeli->setPvm($row->pvm);
			$artikkelit[] = array($artikkeli, $row->id);
		}
		$this->lkm = $stmt->rowCount();
		
		return $artikkelit;
		
		
	}
	
}

?>