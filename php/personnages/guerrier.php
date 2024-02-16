<?php
class Guerrier extends Personnage
{
    // Attributs
    public $coupEpée;

    // Constructeur
    public function __construct($hp, $damage, $coupEpée)
    {
        parent::__construct($hp, $damage);
        $this->coupEpée = $coupEpée;
    }

    // Méthode pour l'attaque spéciale
    public function attaquerSpecial($adversaire)
    {
        $adversaire->hp -= $this->coupEpée;
    }

    // Méthode pour obtenir le nom de l'attaque spéciale
    public function nomAttaqueSpeciale()
    {
        return "Coup d'épée";
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