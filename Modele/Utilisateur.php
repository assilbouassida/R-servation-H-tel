<?php

class Utilisateur {
    private $id;
    private $nom;
    private $email;
    private $motDePasse;
    private $role;
    private $image;

  
    public function __construct($id, $nom, $email, $motDePasse, $role, $image = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
        $this->image = $image;  
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
        return $this->nom.$this->email.$this->role;
    }

   
}

?>