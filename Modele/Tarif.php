<?php
include 'ConnexionBD.php';
class Tarif {
    private $id;
    private $saisonId;
    private $typeChambreId;
    private $prix;

    public function __construct($id, $saisonId, $typeChambreId, $prix) {
        $this->id = $id;
        $this->saisonId = $saisonId;
        $this->typeChambreId = $typeChambreId;
        $this->prix = $prix;
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
        return   $this->saisonId. $this->typeChambreId. $this->prix;
    }
    public static function findBySeasonAndTypeChambre($saisonId, $typeChambreId) {
        $pdo = ConnexionBD::getInstance();
    
        $stmt = $pdo->prepare("SELECT * FROM Tarif WHERE id_sai = ? AND id_type_ch = ?");
        $stmt->execute([$saisonId, $typeChambreId]);
        $tarifData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($tarifData) {
            return new self(
                $tarifData['id'],
                $tarifData['id_sai'],
                $tarifData['id_type_ch'],
                $tarifData['prix']
            );
        } else {
            return null; 
        }
    }
    public static function ajouter($saisonId, $typeChambreId, $prix) {
        $pdo = ConnexionBD::getInstance();
        $sql = "INSERT INTO tarif (id_sai, id_type_ch, prix) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$saisonId, $typeChambreId, $prix]);
    }

    
    public static function modifier($id, $saisonId, $typeChambreId, $prix) {
        $pdo = ConnexionBD::getInstance();
        $sql = "UPDATE tarif SET id_sai = ?, id_type_ch = ?, prix = ? WHERE id_tarif = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$saisonId, $typeChambreId, $prix, $id]);
    }

    public static function supp($id) {
        $pdo = ConnexionBD::getInstance();
        $sql = "DELETE FROM tarif WHERE id_tarif = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function findAll() {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM tarif");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function findById($id) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM tarif WHERE id_tarif = ?");
        $stmt->execute([$id]);
        $tarifData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($tarifData) {
            return new self(
                $tarifData['id_tarif'], 
                $tarifData['id_sai'],     
                $tarifData['id_type_ch'],
                $tarifData['prix']
            );
        } else {
            return null;
        }
    }
}

?>
