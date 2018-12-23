<?php
require_once 'Header.php';

//-------2. Associations 1-n -----------
use catawich\models\Sandwich;
use catawich\models\Image;

//------1-------
//afficher le sandwich n°4 et lister les images associées

$sand1 = Sandwich::select()->find(4);
$imgs1 = $sand1->images()->get();

echo "\n-----------------------ex1---------------------------- \n\n";

echo "nom : ".$sand1->nom . " \n";
echo "description : ".$sand1->description . " \n";
echo "type_pain : ".$sand1->type_pain . " \n"; 

foreach ($imgs1 as  $img) {
    echo "\n ------------ \n";
    echo "titre : ".$img->titre . " \n";
    echo "type : ".$img->type . " \n";
    echo "filename : ".$img->filename . " \n";
}


//------2-------
//lister l'ensemble des sandwichs, triés par type de pain, 
//et pour chaque sandwich afficher la liste des images associées.
//Utiliser un chargement lié.

$sandwichs2 = Sandwich::with('images')->orderBy('type_pain','ASC')->get();

echo "\n-----------------------ex2---------------------------- \n\n";

foreach($sandwichs2 as $s){
    echo "\n ------------------------------------ \n";
    echo "nom : ".$s->nom . " \n";
    echo "description : ".$s->description . " \n";
    echo "type_pain : ".$s->type_pain . " \n";
    foreach($s->images as $img){
        echo "\n ------------ \n";
        echo "filename : ".$img->filename . " \n";
    }
}


//------3-------
//lister les images et indiquer pour chacune 
//d'elle le sandwich associé en affichant son nom et son type de pain.

$images1 = Image::with('sandwich')->get();

echo "\n-----------------------ex3---------------------------- \n\n";

foreach($images1 as $img){
    echo "\n ------------ \n";
    echo "filename : ".$img->filename . " \n";
    echo "nom sandwich : ".$img->sandwich->nom . " \n";
    echo "type pain sandwich : ".$img->sandwich->type_pain . " \n";
}



//------4-------
//créer 3 images associées au sandwich ajouté dans l'exercice 1.

echo "\n-----------------------ex4---------------------------- \n\n";

$mySandwich = Sandwich::select()->find(10);

$newImg1 = new Image();
$newImg1->titre = 'mounach1';
$newImg1->filename = 'newImg1.jpg';
$newImg1->sandwich()->associate($mySandwich);
$newImg1->save();

$newImg2 = new Image();
$newImg2->titre = 'mounach2';
$newImg2->filename = 'newImg2.jpg';
$newImg2->sandwich()->associate($mySandwich);
$newImg2->save();

$newImg3 = new Image();
$newImg3->titre = 'mounach3';
$newImg3->filename = 'newImg3.jpg';
$newImg3->sandwich()->associate($mySandwich);
$newImg3->save();

echo "\n img1,img2,img3 inserted \n";

//------5-------
//changer le sandwich associé à la 3ème image créée et le remplacer par le sandwich d'Id 6

echo "\n-----------------------ex5---------------------------- \n\n";

$sandwich5 = Sandwich::select()->find(6);

$img3 = Image::select()->find(44);

$img3->sandwich()->associate($sandwich5);

$img3->save();


echo "\n associate sandwich 6 to img 44 \n";





?>