<?php
class Archer extends Personnage
{
    // Attributs
    public $tirMortel;

    // Constructeur
    public function __construct($hp, $damage, $tirMortel)
    {
        parent::__construct($hp, $damage);
        $this->tirMortel = $tirMortel;
    }

    // Méthode pour l'attaque spéciale
    public function attaquerSpecial($adversaire)
    {
        $adversaire->hp -= $this->tirMortel;
    }

    // Méthode pour obtenir le nom de l'attaque spéciale
    public function nomAttaqueSpeciale()
    {
        return "Tir Mortel";
    }

    // Méthode pour utiliser l'attaque spéciale une seule fois
    public function utiliserAttaqueSpeciale($adversaire)
    {
        if (!$this->attaqueSpecialeUtilisee) {
            $this->attaquerSpecial($adversaire);
            $this->attaqueSpecialeUtilisee = true;
        }
    }

}
?>