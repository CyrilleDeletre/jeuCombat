<?php
session_start();

include 'personnages/personnage.php';
include 'personnages/guerrier.php';
include 'personnages/mage.php';
include 'personnages/archer.php';
include 'personnages/pretre.php';

// Variable de session pour suivre si les classes ont été choisies
if (!isset($_SESSION['classes_choisies'])) {
    $_SESSION['classes_choisies'] = false;
}


// Instanciation des joueurs
$joueur1 = isset($_SESSION['joueur1']) ? $_SESSION['joueur1'] : null;
$joueur2 = isset($_SESSION['joueur2']) ? $_SESSION['joueur2'] : null;

// Vérification de la soumission du formulaire de sélection de classes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lancer_combat'])) {
    $classe_joueur1 = $_POST['joueur1_classe'];
    $classe_joueur2 = $_POST['joueur2_classe'];

    // Instanciation des joueurs en fonction des classes sélectionnées
    if ($classe_joueur1 === 'Guerrier') {
        $joueur1 = new Guerrier(175, 15, 30);
    } 
    elseif ($classe_joueur1 === 'Mage') {
        $joueur1 = new Mage(100, 25, 50);
    }
    elseif ($classe_joueur1 === 'Archer') {
        $joueur1 = new Archer(150, 20, 40);
    }
    elseif ($classe_joueur1 === 'Pretre') {
        $joueur1 = new Pretre(125, 10, 20);
    }

    if ($classe_joueur2 === 'Guerrier') {
        $joueur2 = new Guerrier(175, 15, 30);
    } 
    elseif ($classe_joueur2 === 'Mage') {
        $joueur2 = new Mage(100, 25, 50);
    }
    elseif ($classe_joueur2 === 'Archer') {
        $joueur2 = new Archer(150, 20, 40);
    }
    elseif ($classe_joueur2 === 'Pretre') {
        $joueur2 = new Pretre(125, 10, 20);
    }

    // Marquer que les classes ont été choisies dans la variable de session
    $_SESSION['classes_choisies'] = true;
}

// Si le paramètre 'reset' est présent dans l'URL, réinitialisez le jeu
if (isset($_GET['reset'])) {
    // Détruisez la session
    session_destroy();
    // Redirigez vers la page pour éviter le rechargement du formulaire par l'utilisateur
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Vérification de l'existence des joueurs avant de les utiliser
if ($joueur1 && $joueur2) {
    // Si une attaque est effectuée par le joueur 1
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_joueur1'])) {
        // Application des dégâts au joueur 2
        $attaque_joueur1_disabled = 'disabled';
        $attaque_special_joueur1_disabled= 'disabled';
        $joueur1->attaquer($joueur2);
        
        // Vérification si le joueur 2 est mort
        if (!$joueur2->estVivant()) {
            $fin_du_jeu = true;
            echo "Joueur 1 a gagné!";
        }
    }

    // Si une attaque est effectuée par le joueur 2
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_joueur2'])) {
        // Application des dégâts au joueur 1
        $attaque_joueur2_disabled = 'disabled';
        $attaque_special_joueur2_disabled= 'disabled';
        $joueur2->attaquer($joueur1);
        
        // Vérification si le joueur 1 est mort
        if (!$joueur1->estVivant()) {
            $fin_du_jeu = true;
            echo "Joueur 2 a gagné!";
        }
    }

    // Si une attaque spéciale est effectuée par le joueur 1
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_speciale_joueur1'])) {
        // Application des dégâts spéciaux au joueur 2
        $attaque_joueur1_disabled = 'disabled';
        $attaque_special_joueur1_disabled= 'disabled';
        $joueur1->utiliserAttaqueSpeciale($joueur2);
        
        // Vérification si le joueur 2 est mort
        if (!$joueur2->estVivant()) {
            $fin_du_jeu = true;
            echo "Joueur 1 a gagné!";
        }
    }

    // Si une attaque spéciale est effectuée par le joueur 2
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attaque_speciale_joueur2'])) {
        // Application des dégâts spéciaux au joueur 1
        $attaque_joueur2_disabled = 'disabled';
        $attaque_special_joueur2_disabled= 'disabled';
        $joueur2->utiliserAttaqueSpeciale($joueur1);
        
        // Vérification si le joueur 1 est mort
        if (!$joueur1->estVivant()) {
            $fin_du_jeu = true;
            echo "Joueur 2 a gagné!";
        }
    }
}

// Sauvegardez les joueurs dans la session
$_SESSION['joueur1'] = $joueur1;
$_SESSION['joueur2'] = $joueur2;

// Si l'un des joueurs est mort, désactiver tous les boutons d'attaque
if ($joueur1 && $joueur2 && (!$joueur1->estVivant() || !$joueur2->estVivant())) {
    $attaque_joueur1_disabled = 'disabled';
    $attaque_joueur2_disabled = 'disabled';
    $attaque_special_joueur1_disabled = 'disabled';
    $attaque_special_joueur2_disabled = 'disabled';
}
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

    <?php if (!$_SESSION['classes_choisies']) : ?>
        <form method="post">
            <fieldset>
                <legend>Choix des classes</legend>
                <label for="joueur1_classe">Classe du Joueur 1:</label>
                <select name="joueur1_classe" id="joueur1_classe">
                    <option value="Guerrier">Guerrier</option>
                    <option value="Mage">Mage</option>
                    <option value="Archer">Archer</option>
                    <option value="Pretre">Prêtre</option>
                </select>
                <br>
                <label for="joueur2_classe">Classe du Joueur 2:</label>
                <select name="joueur2_classe" id="joueur2_classe">
                    <option value="Guerrier">Guerrier</option>
                    <option value="Mage">Mage</option>
                    <option value="Archer">Archer</option>
                    <option value="Pretre">Prêtre</option>
                </select>
                <br>
                <button type="submit" name="lancer_combat">Lancer le combat</button>
            </fieldset>
        </form>
    <?php endif; ?>

    <?php if ($joueur1 && $joueur2) : ?>
        <form method="post">
            <fieldset>
                <legend>Joueur 1</legend>
                <button type="submit" name="attaque_joueur1" <?php echo isset($attaque_joueur1_disabled) ? 'disabled' : ''; ?>>Attaque de base</button>
                <button type="submit" name="attaque_speciale_joueur1" <?php echo (isset($attaque_special_joueur1_disabled) || $joueur1->attaqueSpecialeUtilisee) ? 'disabled' : ''; ?>><?php echo $joueur1->nomAttaqueSpeciale(); ?></button>
            </fieldset>
        </form>

        <form method="post">
            <fieldset>
                <legend>Joueur 2</legend>
                <button type="submit" name="attaque_joueur2" <?php echo isset($attaque_joueur2_disabled) ? 'disabled' : ''; ?>>Attaque de base</button>
                <button type="submit" name="attaque_speciale_joueur2" <?php echo (isset($attaque_special_joueur2_disabled) || $joueur2->attaqueSpecialeUtilisee) ? 'disabled' : ''; ?>><?php echo $joueur2->nomAttaqueSpeciale(); ?></button>
            </fieldset>
        </form>
    <div>
        <?php
        // Affichage des points de vie
        echo "<br>";
        echo "PV du joueur 1 : " . $joueur1->hp . "<br>";
        echo "PV du joueur 2 : " . $joueur2->hp . "<br>";
        echo "<br>";
        ?>
    </div>
<?php endif; ?>


    <a href="?reset=true">Réinitialiser le jeu</a>
</body>

</html>