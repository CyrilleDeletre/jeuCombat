<?php
class Personnage
{
    // Attributs
    public $hp;
    public $damage;
    public $attaqueSpecialeUtilisee;

    // Constructeur
    public function __construct($hp, $damage)
    {
        $this->hp = $hp;
        $this->damage = $damage;

        // Limitation à 1 Attaque speciale par combat
        $this->attaqueSpecialeUtilisee = false;
    }

    // Méthode pour calculer les dégâts
    public function attaquer($adversaire)
    {
        $adversaire->hp -= $this->damage;
    }

    // Méthode pour vérifier si le personnage est en vie
    public function estVivant()
    {
        return $this->hp > 0;
    }

    // Méthode pour réinitialiser une partie
    public function reinitialiser()
    {
        $this->hp = 100;
        $this->attaqueSpecialeUtilisee = false;
    }
}

?>