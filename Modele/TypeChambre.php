<?php
include 'ConnexionBD.php';
class TypeChambre {
    private $id;
    private $libelle;
    private $description;
    private $nombreChambres;

    public function __construct($id, $libelle, $description, $nombreChambres) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->nombreChambres = $nombreChambres;
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
        return  $this->libelle.$this->description;
    }

    public static function findById($id) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM type_chambre WHERE id_type_ch = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new self(
                $result['id_type_ch'],
                $result['libelle_type_ch'],
                $result['description'],
                $result['nb_ch']
            );
        } else {
            return null;
        }
    }
    public static function findAll() {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM type_chambre");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
 
public static function findByLibelle($libelle) {
    $pdo = ConnexionBD::getInstance();
    $stmt = $pdo->prepare("SELECT * FROM type_chambre WHERE libelle_type_ch = ?");
    $stmt->execute([$libelle]);
    $typeChambre = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($typeChambre) {
        return new self(
            $typeChambre['id_type_ch'],
            $typeChambre['libelle_type_ch'],
            $typeChambre['description'],
            $typeChambre['nb_ch']
        );
    } else {
        return null;
    }
}

}

?>
