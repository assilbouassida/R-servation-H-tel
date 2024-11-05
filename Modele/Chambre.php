<?php

include 'ConnexionBD.php';

class Chambre {
    private $id;
    private $typeChambreId;
    private $numero;
    private $statut;

    public function __construct($id, $typeChambreId, $numero, $statut) {
        $this->id = $id;
        $this->typeChambreId = $typeChambreId;
        $this->numero = $numero;
        $this->statut = $statut;
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
        return $this->numero . $this->statut;
    }
    public static function findAll() {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM chambre");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function findAvailableByType($typeChambreId) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM chambre WHERE id_type_ch = ? AND statut = 'disponible'");
        $stmt->execute([$typeChambreId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Chambre');
    }

    public static function ajouter($typeChambreId, $numero, $statut) {
        $pdo = ConnexionBD::getInstance();
        $sql = "INSERT INTO chambre (id_type_ch, num_chambre, statut) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$typeChambreId, $numero, $statut]);
    }

    
    public static function modifier($id, $typeChambreId, $numero, $statut) {
        $pdo = ConnexionBD::getInstance();
        $sql = "UPDATE chambre  SET id_type_ch = ?, num_chambre = ?, statut = ? WHERE id_chambre = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$typeChambreId, $numero, $statut, $id]);
    }


    public static function supp($id) {
        $pdo = ConnexionBD::getInstance();
        $sql = "DELETE FROM chambre WHERE id_chambre = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function findById($id) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM chambre WHERE id_chambre = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new self(
                $result['id_chambre'],
                $result['id_type_ch'],
                $result['num_chambre'],
                $result['statut']
            );
        } else {
            return null;
        }
    }

    public static function findByNumero($numero) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM chambre WHERE num_chambre = ?");
        $stmt->execute([$numero]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new self(
                $result['id_chambre'],
                $result['id_type_ch'],
                $result['num_chambre'],
                $result['statut']
            );
        } else {
            return null;
        }
    }
    public static function search($x) {
        $pdo = ConnexionBD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM chambre WHERE num_chambre LIKE ?");
        $x = "%" . $x . "%";
        $stmt->execute([$x]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    /*-----*/
   
    
    
}

?>
