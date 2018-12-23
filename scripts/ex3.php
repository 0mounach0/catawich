<?php
require_once 'Header.php';

//-------3. Associations N-N -----------
use catawich\models\Sandwich;
use catawich\models\Categorie;

//-----1------
//lister les catégories du sandwich d'ID 5 ; 
//afficher le sandwich (nom, description, type de pain) 
//et le nom de chacune des catégories auxquelles il est associé

$sandwich5 = Sandwich::with('categories')->find(5);

echo "\n-----------------------ex1---------------------------- \n\n";

    echo "\n ------------------------------------ \n";
    echo "nom : ".$sandwich5->nom . " \n";
    echo "description : ".$sandwich5->description . " \n";
    echo "type_pain : ".$sandwich5->type_pain . " \n";
    foreach($sandwich5->categories as $cat){
        echo "\n ------------ \n";
        echo "nom cat: ".$cat->nom . " \n";
    }

//-----2------
//lister l'ensemble des catégories, et pour chaque catégorie 
//la liste de sandwichs associés ;utiliser un chargement lié.

$categories = Categorie::with('sandwichs')->get();

echo "\n-----------------------ex2---------------------------- \n\n";

foreach($categories as $cat){;
        echo "\n ------------------------------------ \n";
        echo "nom cat: ".$cat->nom . " \n";
    foreach($cat->sandwichs as $s){
        echo "\n ------------ \n";
        echo "nom : ".$s->nom . " \n";
        echo "description : ".$s->description . " \n";
        echo "type_pain : ".$s->type_pain . " \n";
    }
}


//-----3------
//lister les sandwichs dont le type_pain contient 'baguette' et pour chaque sandwich, 
//afficher ses catégories et la liste des images qui lui sont associées ; 
//utiliser un chargement lié.

$sandwichs3 = Sandwich::with('categories','images')->where('type_pain','=','baguette')->get();

echo "\n-----------------------ex3---------------------------- \n\n";

foreach($sandwichs3 as $s){
    echo "\n ---------------sand---------------- \n";
    echo "nom : ".$s->nom . " \n";
    echo "description : ".$s->description . " \n";
    echo "type_pain : ".$s->type_pain . " \n";
    foreach($s->images as $img){
        echo "\n ----img----- \n";
        echo "filename : ".$img->filename . " \n";
    }
    foreach($s->categories as $cat){
        echo "\n ------cat----- \n";
        echo "nom cat: ".$cat->nom . " \n";
    }
}



//-----4------
//associer le sandwich créé au 1.5 aux catégories 1 et 3.

echo "\n-----------------------ex4---------------------------- \n\n";

$mySandwich = Sandwich::select()->find(11);

$mySandwich->categories()->sync([1,3]);

$mySandwich->save();

echo "associer le sandwich 11 aux catégories 1 et 3";



















?>