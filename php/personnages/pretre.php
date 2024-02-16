<?php
class Pretre extends Personnage
{
    // Attributs
    public $prièreFuneste;

    // Constructeur
    public function __construct($hp, $damage, $prièreFuneste)
    {
        parent::__construct($hp, $damage);
        $this->prièreFuneste = $prièreFuneste;
    }

    // Méthode pour l'attaque spéciale
    public function attaquerSpecial($adversaire)
    {
        $adversaire->hp -= $this->prièreFuneste;
    }

    // Méthode pour obtenir le nom de l'attaque spéciale
    public function nomAttaqueSpeciale()
    {
        return "Prière funeste";
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