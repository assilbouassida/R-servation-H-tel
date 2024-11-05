<?php
include 'ConnexionBD.php';

class Reservation {
    private $id_reservation;
    private $id_client;
    private $id_chambre;
    private $date_debut;
    private $date_fin;
    private $nb_adultes;
    private $nb_enfants;
    private $etat; 

    
    public function __construct($id_reservation = null, $id_client = null, $id_chambre = null, $date_debut = null, $date_fin = null, $nb_adultes = null, $nb_enfants = null, $etat = null) {
       
        $this->id_reservation = $id_reservation;
        $this->id_client = $id_client;
        $this->id_chambre = $id_chambre;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->nb_adultes = $nb_adultes;
        $this->nb_enfants = $nb_enfants;
        $this->etat = $etat;
    }

    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    
    public function __toString() {
        return 
            $this->id_reservation.$this->id_client.$this->id_chambre.$this->date_debut.$this->date_fin.$this->nb_adultes.$this->nb_enfants.$this->etatToString();
    }

    
    private function etatToString() {
        switch ($this->etat) {
            case 0:
                return 'En attente';
            case 1:
                return 'Validée';
            case 2:
                return 'Terminée';
            default:
                return 'Inconnu';
        }
    }

    public static function findAll() {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM reservation");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Reservation');
    }

    public static function valider($id_reservation) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("UPDATE reservation SET etat = 1 WHERE id_reservation = ?");
        return $stmt->execute([$id_reservation]);
    }

    public static function terminer($id_reservation) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("UPDATE reservation SET etat = 2 WHERE id_reservation = ?");
        return $stmt->execute([$id_reservation]);
    }

    public static function findById($id_reservation) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_reservation = ?");
        $stmt->execute([$id_reservation]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reservation');
        return $stmt->fetch();
    }

    public function save() {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("UPDATE reservation SET id_client = ?, id_chambre = ?, date_debut = ?, date_fin = ?, nb_adultes = ?, nb_enfants = ?, etat = ? WHERE id_reservation = ?");
        $stmt->execute([
            $this->id_client,
            $this->id_chambre,
            $this->date_debut,
            $this->date_fin,
            $this->nb_adultes,
            $this->nb_enfants,
            $this->etat,
            $this->id_reservation
        ]); 
    }
    public static function termine($date) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM reservation WHERE date_fin < ?");
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Reservation');
    }
    
    public static function search($x) {
        $pdo = ConnexionBD::getInstance();
        
        $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_reservation LIKE ? ");
        $x = "%" . $x . "%";
        $stmt->execute([$x]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Reservation');
    }

    public static function updateNumeroChambre($id_reservation, $id_chambre) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("UPDATE reservation SET id_chambre = ? WHERE id_reservation = ?");
        return $stmt->execute([$id_chambre, $id_reservation]);
    }
}

?>
