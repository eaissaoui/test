<?php

// récupère les priorités existantes pour un ticket
function getPriorite() {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT nom_priorite
		FROM gsb_priorite");
		
	$requete->execute();
	
	while ($prio = $requete->fetch(PDO::FETCH_ASSOC)) {
		$result[] = $prio['nom_priorite'];
	}
	
	$requete->closeCursor();
	return $result;
}

// récupère les catégories existantes pour un ticket
function getCategorie() {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT nom_categorie
		FROM gsb_categorie");
		
	$requete->execute();
	
	while ($cat = $requete->fetch(PDO::FETCH_ASSOC)) {
		$result[] = $cat['nom_categorie'];
	}
	
	$requete->closeCursor();
	return $result;
}

?>