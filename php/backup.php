<?php
// Démarrez ou restaurez la session
session_start();

// Définition de la classe Personnage
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

        // 1 Attaque speciale par combat
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

    // Méthode pour réinitialiser les points de vie et l'attaque spéciale
    public function reinitialiser()
    {
        $this->hp = 100;
        $this->attaqueSpecialeUtilisee = false;
    }

}


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

        // Méthode pour utiliser l'attaque spéciale
        public function utiliserAttaqueSpeciale($adversaire)
        {
            if (!$this->attaqueSpecialeUtilisee) {
                $this->attaquerSpecial($adversaire);
                $this->attaqueSpecialeUtilisee = true;
            }
        }

    // Méthode pour l'attaque spéciale du Guerrier (coup d'épée)
    public function attaquerSpecial($adversaire)
    {
        $adversaire->hp -= $this->coupEpée;
    }
}

class Mage extends Personnage
{
    public $bouleDeFeu;

    // Constructeur
    public function __construct($hp, $damage, $bouleDeFeu)
    {
        parent::__construct($hp, $damage);
        $this->bouleDeFeu = $bouleDeFeu;
    }

        // Méthode pour utiliser l'attaque spéciale
        public function utiliserAttaqueSpeciale($adversaire)
        {
            if (!$this->attaqueSpecialeUtilisee) {
                $this->attaquerSpecial($adversaire);
                $this->attaqueSpecialeUtilisee = true;
            }
        }

    // Méthode pour l'attaque spéciale du Mage (boule De Feu)
    public function attaquerSpecial($adversaire)
    {
        $adversaire->hp -= $this->bouleDeFeu;
    }
}


// Si le paramètre 'reset' est présent dans l'URL, réinitialisez le jeu
if (isset($_GET['reset'])) {
    // Détruisez la session
    session_destroy();
    // Redirigez vers la page pour éviter le rechargement du formulaire par l'utilisateur
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Restaurez les joueurs à partir de la session s'ils existent, sinon créez-les
$joueur1 = isset($_SESSION['joueur1']) ? $_SESSION['joueur1'] : new Guerrier(100, 5, 10);
$joueur2 = isset($_SESSION['joueur2']) ? $_SESSION['joueur2'] : new Mage(50, 10, 20);

// Si une attaque est effectuée par le joueur 1
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_joueur1'])) {
    // Application des dégâts au joueur 2
    $joueur1->attaquer($joueur2);
    $attaque_joueur1_disabled = 'disabled';
    $attaque_special_joueur1_disabled = 'disabled';
    // Vérification si le joueur 2 est mort
    if (!$joueur2->estVivant()) {
        $fin_du_jeu = true;
        echo "Joueur 1 a gagné!";
    }
}

// Si une attaque est effectuée par le joueur 2
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_joueur2'])) {
    // Application des dégâts au joueur 1
    $joueur2->attaquer($joueur1);
    $attaque_joueur2_disabled = 'disabled';
    $attaque_special_joueur2_disabled = 'disabled';
    // Vérification si le joueur 1 est mort
    if (!$joueur1->estVivant()) {
        $fin_du_jeu = true;
        echo "Joueur 2 a gagné!";
    }
}

// Si une attaque spéciale est effectuée par le joueur 1
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_speciale_joueur1'])) {
    // Application des dégâts spéciaux au joueur 2
    $joueur1->utiliserAttaqueSpeciale($joueur2);
    $attaque_joueur1_disabled = 'disabled';
    $attaque_special_joueur1_disabled = 'disabled';
    // Vérification si le joueur 2 est mort
    if (!$joueur2->estVivant()) {
        $fin_du_jeu = true;
        echo "Joueur 1 a gagné!";
    }
}

// Si une attaque spéciale est effectuée par le joueur 2
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_speciale_joueur2'])) {
    // Application des dégâts spéciaux au joueur 1
    $joueur2->utiliserAttaqueSpeciale($joueur1);
    $attaque_joueur2_disabled = 'disabled';
    $attaque_special_joueur2_disabled = 'disabled';
    
    // Vérification si le joueur 1 est mort
    if (!$joueur1->estVivant()) {
        $fin_du_jeu = true;
        echo "Joueur 2 a gagné!";
    }
}

// Sauvegardez les joueurs dans la session
$_SESSION['joueur1'] = $joueur1;
$_SESSION['joueur2'] = $joueur2;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat au tour par tour</title>
</head>

<body>
    <h1>Combat au tour par tour</h1>
    <form method="post">
        <fieldset>
            <legend>Guerrier</legend>
            <button type="submit" name="attaque_joueur1" <?php echo isset($attaque_joueur1_disabled) ? 'disabled' : ''; ?>>Attaque de base</button>
            <button type="submit" name="attaque_speciale_joueur1" <?php echo (isset($attaque_special_joueur1_disabled) || $joueur1->attaqueSpecialeUtilisee) ? 'disabled' : ''; ?>>Coup d'épée fracassant</button>
        </fieldset>
    </form>

    <form method="post">
        <fieldset>
            <legend>Mage</legend>
            <button type="submit" name="attaque_joueur2" <?php echo isset($attaque_joueur2_disabled) ? 'disabled' : ''; ?>>Attaque de base</button>
            <button type="submit" name="attaque_speciale_joueur2" <?php echo (isset($attaque_special_joueur2_disabled) || $joueur2->attaqueSpecialeUtilisee) ? 'disabled' : ''; ?>>Boule de feu</button>
        </fieldset>
    </form>

    <div>
        <?php
        // Affichage des points de vie
        echo "<br>";
        echo "Guerrier PV: " . $joueur1->hp . "<br>";
        echo "Mage PV: " . $joueur2->hp . "<br>";
        echo "<br>";
        ?>
    </div>

    <a href="?reset=true">Réinitialiser le jeu</a>
</body>

</html>