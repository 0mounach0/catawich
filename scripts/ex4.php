<?php
require_once 'Header.php';

//-------4. Attributs d'associations -----------
use catawich\models\Sandwich;

//------1------
//afficher la liste des tailles proposées pour le sandwich d'ID 5

$sandwich5 = Sandwich::with('tailles')->find(5);

echo "\n-----------------------ex1---------------------------- \n\n";

foreach ($sandwich5->tailles as $t) {
    echo "\n ----------- \n";
    echo "nom taille : $t->nom";
}
echo "\n\n";

//-----2------
//afficher la liste des tailles proposées pour le sandwich d'ID 5
//mais en ajoutant le prix du sandwich pour chaque taille

$sandwich6 = Sandwich::with('tailles')->find(5);

echo "\n-----------------------ex2---------------------------- \n\n";

foreach ($sandwich6->tailles as $t) {
    echo "\n ----------- \n";
    echo "nom taille : $t->nom";
    echo "\nprix taille : ".$t->pivot->prix;
}

echo "\n\n";

//-----3------
//associer le sandwich créé au 1.5 aux différentes tailles 
//existantes en précisant le prix dans chaque cas.

$mySandwich = Sandwich::select()->find(11);

echo "\n-----------------------ex2---------------------------- \n\n";

$mySandwich->tailles()->sync([
                    1 => ['prix' => 10],
                    2 => ['prix' => 20],
                    3 => ['prix' => 30],
                    4 => ['prix' => 40]
                    ]);

$mySandwich->save();

echo "\n associer le sandwich 11 aux différentes tailles \n";





?>