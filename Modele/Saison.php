<?php 
include 'ConnexionBD.php';
class Saison {
    private $id;
    private $libelle;
    private $dateDebut;
    private $dateFin;

    public function __construct($id, $libelle, $dateDebut, $dateFin) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
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
        return  $this->libelle. $this->dateDebut. $this->dateFin;
    }
    public static function findSeasonByDate($date) {
        $pdo = ConnexionBD::getInstance();
    
        $stmt = $pdo->prepare("SELECT * FROM Saison WHERE dat_deb_sai <= ? AND dat_fin_sai >= ?");
        $stmt->execute([$date, $date]);
        $seasonData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($seasonData) {
            return new self(
                $seasonData['id_sai'],
                $seasonData['libelle_sai'],
                $seasonData['dat_deb_sai'],
                $seasonData['dat_fin_sai']
            );
        } else {
            return null; 
        }
    }

    public static function findAll() {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM saison");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function findById($id) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM Saison WHERE id_sai = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new self(
                $result['id_sai'],
                $result['libelle_sai'],
                $result['dat_deb_sai'],
                $result['dat_fin_sai']
            );
        } else {
            return null;
        }
    }
}

?>
