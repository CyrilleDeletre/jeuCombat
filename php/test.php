

<?php

// class Personnage{
//     // Attributs

//         // Niveau
//         public $niveau = 1;

//         // Stats Majeurs
//         public $pdv = 60;
//         public $armure = 0;
//         public $pa = 6;
//         public $pm = 3;
//         public $pw = 6;
//         public $po = 0;
//         public $contrôle = 1;

//         // Elémentaire
//         // public $maîtriseEau = 0;
//         // public $résistanceEau = 0;

//         // public $maîtriseTerre = 0;
//         // public $résistanceTerre = 0;

//         // public $maîtriseAir = 0;
//         // public $résistanceAir = 0;

//         // public $maîtriseFeu = 0;
//         // public $résistanceFeu = 0;

//         public $maîtrises = 10;

//         // Stats principal
//         public $dommagesInfligés = 0;
//         public $soinsRéalisés = 0;
//         public $coupCritique = 3;
//         public $parade = 0;
//         public $initiative = 0;
//         public $esquive = 0;
//         public $tacle = 0;
//         public $sagesse = 0;
//         public $prospection = 0;
//         public $volonté = 0;

//         // Stats secondaire
//         public $maîtriseCritique = 0;
//         public $résistanceCritique = 0;
//         public $maîtriseDos = 0;
//         public $résistanceDos = 0;
//         public $maîtriseMêlée = 0;
//         public $maîtriseDistance = 0;
//         public $maîtriseSoin = 0;
//         public $maîtriseBerserk = 0;

//     // Construct 
//     public function __construct($pdv, $pa, $maîtrises) {
//         $this->pdv = $pdv;
//         $this->pa = $pa;
//         $this->maîtrises = $maîtrises;
//     }

//     // Méthode
//     public function stats(){
//         return "PdV : " . $this->pdv . ", PA : " . $this->pa . ", Maîtrises : " . $this->maîtrises;
//     }
// }

// class Xélor extends Personnage{
//     public function class() {
//         echo "Xélor";
//     }
    
//     public function sort(){
//         // echo "Martel'heure, 3 PA, 1-4 PO Modifiable, en ligne";
//         // echo "<br>";
//         // echo "Dommage eau : 92";
//         // echo "<br>";
//         // echo "-1 PA";
//         // echo "<br>";
//         // echo "À chaque lancer du sort, Répète ses effets sur les cibles précédentes";
//         // echo "<hr>";
//     }

// }

// class Sacrieur extends Personnage{
    
//     public function class() {
//         echo "Sacrieur";
//     }

//     public function sort(){
//         // echo "Sang pour sang, 3 PA, 1-1 PO";
//         // echo "<br>";
//         // echo "Dommage feu : 112";
//         // echo "<br>";
//         // echo "Le lanceur s'inflige un Retour de flamme : Dommage feu : 37";
//         // echo "<hr>";
//     }

// }

// class Crâ extends Personnage{
    
//     public function class() {
//         echo "Crâ";
//     }

//     public function sort(){
//         // echo "Flèche cinglante, 3 PA, 2-4 PO Modifiable";
//         // echo "<br>";
//         // echo "Dommage terre : 71";
//         // echo "-2 PM";
//         // echo "<br>";
//         // echo "Tir précis : -4 PM";
//         // echo "<br>";
//         // echo "Consomme 45 de Précision";
//         // echo "<hr>";
//     }

// }

// class Sram extends Personnage{
    
//     public function class() {
//         echo "Sram";
//     }

//     public function sort(){
//         // echo "Coup pénétrant, 4 PA, 1-1 PO";
//         // echo "<br>";
//         // echo "Dommage air : 150";
//         // echo "<br>";
//         // echo "Le lanceur gagne Point Faible (+20 Niv.)";
//         // echo "<hr>";
//     }

// }

// $nox = new Xélor(2500, 12, 200);
// $krissLaCrasse = new Sacrieur(3500, 12, 100);
// $evangelyne = new Crâ(2000, 12, 250);
// $maude = new Sram(3000, 12, 150);

// $player1;
// $player2;