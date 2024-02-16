<?php
class Mage extends Personnage
{
    // Attributs
    public $bouleDeFeu;

    // Constructeur
    public function __construct($hp, $damage, $bouleDeFeu)
    {
        parent::__construct($hp, $damage);
        $this->bouleDeFeu = $bouleDeFeu;
    }

    // Méthode pour l'attaque spéciale
    public function attaquerSpecial($adversaire)
    {
        $adversaire->hp -= $this->bouleDeFeu;
    }

    // Méthode pour obtenir le nom de l'attaque spéciale
    public function nomAttaqueSpeciale()
    {
        return "Boule de feu";
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