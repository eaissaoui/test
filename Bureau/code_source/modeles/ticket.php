<?php
	class Ticket
	{
		private $db;
		private $id;
		private $titre;
		private $contenu;
		private $date;
		private $id_cat;
		private $id_prio;
		private $id_user;
		private $statut;

		public function __construct()
		{
			$this->db = PDO2::getInstance();
			if(func_num_args())
			{
				$data = func_get_arg(0);
				if (isset($data['id_ticket'])) $this->id = $data['id_ticket'];
				$this->titre = $data['titre_ticket'];
				$this->contenu = $data['contenu_ticket'];
				$this->date = $data['date_creation_ticket'];
				$this->id_cat = $data['id_categorie'];
				$this->id_prio = $data['id_priorite'];
				$this->id_user = $data['id_utilisateur'];
				$this->statut = $data['nom_etat'];
			}
		}

		// Getters
		public function getId() { return $this->id; }
		public function getTitre() { return $this->titre; }
		public function getContenu() { return $this->contenu; }
		public function getDate() { return $this->date; }
		public function getIdCat() { return $this->id_cat; }
		public function getIdPrio() { return $this->id_prio; }
		public function getIdUser() { return $this->id_user; }
		public function getStatut() { return $this->statut; }
		
		// Setters
		public function setId($id) { $this->id = $id; }
		public function setTitre($titre) { $this->titre = $titre; }
		public function setContenu($contenu) { $this->contenu = $contenu; }
		public function setDate($date) { $this->date = $date; }
		
		public function setIdCat($id_cat) { 
			if(is_numeric($id_cat))
			{
				$query = $this->db->prepare("SELECT nom_categorie FROM gsb_categorie WHERE id_categorie = :id_cat");
				$query->bindValue(':id_cat', $id_cat);
				$query->execute();
				$data = $query->fetch(PDO::FETCH_ASSOC);
				$this->id_cat = $data['nom_categorie'];
			}
			else $this->id_cat = $id_cat; 
		}

		public function setIdPrio($id_prio) { 
			if(is_numeric($id_prio))
			{
				$query = $this->db->prepare("SELECT nom_priorite FROM gsb_priorite WHERE id_priorite = :id_prio");
				$query->bindValue(':id_prio', $id_prio);
				$query->execute();
				$data = $query->fetch(PDO::FETCH_ASSOC);
				$this->id_prio = $data['nom_priorite'];
			}
			else $this->id_prio = $id_prio; 
		}

		public function setIdUser($id_user) { $this->id_user = $id_user; }

		public function setStatut($statut) { 
			if(is_numeric($statut))
			{
				$query = $this->db->prepare("SELECT nom_etat FROM gsb_etat NATURAL JOIN gsb_avoir WHERE id_ticket = :id_ticket ORDER BY date_etat DESC LIMIT 1");
				$query->bindValue(':id_ticket', $this->getId());
				$query->execute();
				$data = $query->fetch(PDO::FETCH_ASSOC);
				$this->statut = $data['nom_etat'];
			}
			else $this->statut = $statut; 
		}
				
		public function creerTicket()
		{
			// Préparation de la requête
			$query = $this->db->prepare("INSERT INTO gsb_ticket SET titre_ticket = :titre, contenu_ticket = :contenu, date_creation_ticket = :date, id_categorie = :id_cat, id_priorite = :id_prio, id_utilisateur = :id_user");
			// Affectation des valeurs
			$query->bindValue(':titre', $this->getTitre());
			$query->bindValue(':contenu', $this->getContenu());
			$query->bindValue(':date', $this->getDate());
			$query->bindValue(':id_cat', $this->getIdCat(), PDO::PARAM_INT);
			$query->bindValue(':id_prio', $this->getIdPrio(), PDO::PARAM_INT);
			$query->bindValue(':id_user', $this->getIdUser(), PDO::PARAM_INT);
			// Exécution de la requête
			$query->execute();
			$query = $this->db->prepare("INSERT INTO gsb_avoir SET id_ticket = :id, id_etat = 1, date_etat = :date");
			$query->bindValue(':id', $this->db->lastInsertId());
			$query->bindValue(':date', $this->getDate());
			$query->execute();
		}

		public function recupDernierTicket($id)
		{
			// Préparation de la requête
			$query = $this->db->prepare("SELECT * FROM gsb_ticket NATURAL JOIN gsb_avoir WHERE id_utilisateur = :id ORDER BY date_creation_ticket DESC LIMIT 1");
			// Affectation des valeurs
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			// Exécution de la requête
			$query->execute();
			if($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$query->closeCursor();
				$this->setId($data['id_ticket']) ;
				$this->setTitre($data['titre_ticket']) ;
				$this->setContenu($data['contenu_ticket']); 
				$this->setDate($data['date_creation_ticket']) ;
				$this->setIdCat($data['id_categorie']) ;
				$this->setIdPrio($data['id_priorite']) ;
				$this->setIdUser($data['id_utilisateur']) ;
				$this->setStatut($data['id_etat']) ;
				return true;
			}
			else return false;
		}

		public function getLastStatut($id)
		{
			// Préparation de la requête
			$query = $this->db->prepare("SELECT nom_etat FROM gsb_avoir NATURAL JOIN gsb_etat WHERE id_ticket = :id ORDER BY date_etat DESC LIMIT 1");
			// Affectation des valeurs
			$query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
			// Exécution de la requête
			$query->execute();
			$data = $query->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		public function getTicket($id)
		{
			// Préparation de la requête
			$query = $this->db->prepare("SELECT * FROM gsb_ticket NATURAL JOIN gsb_avoir WHERE id_ticket = :id");
			// Affectation des valeurs
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			// Exécution de la requête
			$query->execute();
			if($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$query->closeCursor();
				$this->setId($data['id_ticket']) ;
				$this->setTitre($data['titre_ticket']) ;
				$this->setContenu($data['contenu_ticket']); 
				$this->setDate($data['date_creation_ticket']) ;
				$this->setIdCat($data['id_categorie']) ;
				$this->setIdPrio($data['id_priorite']) ;
				$this->setIdUser($data['id_utilisateur']) ;
				$this->setStatut($data['id_etat']) ;
				return true;
			}
			else return false;
		}

		public function recupHistoTickets($id)
		{
			// Préparation de la requête
			$query = $this->db->prepare("SELECT * FROM gsb_ticket NATURAL JOIN gsb_avoir NATURAL JOIN gsb_etat WHERE id_utilisateur = :id GROUP BY id_ticket ORDER BY date_creation_ticket DESC");
			// Affectation des valeurs
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			// Exécution de la requête
			$query->execute();
			$Tickets = array();
			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{	
				$Ticket = new Ticket($data);
				$LastStatut = $Ticket->getLastStatut($Ticket->getId());
				$Ticket->setStatut($LastStatut['nom_etat']);
				$Tickets[] = $Ticket;
			}
			return $Tickets;
		}

		public function getHistoStatut()
		{
			// Préparation de la requête
			$query = $this->db->prepare("SELECT * FROM gsb_avoir NATURAL JOIN gsb_etat WHERE id_ticket = :id ORDER BY date_etat DESC");
			// Affectation des valeurs
			$query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
			// Exécution de la requête
			$query->execute();
			$statuts = array();
			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{		
				$statuts[] = $data;
			}
			return $statuts;
		}
	}
?>
