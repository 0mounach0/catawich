<?php
require_once 'Header.php';

//-------5. Requêtes sur des associations -----------
use catawich\models\Sandwich;
use catawich\models\Image;
use catawich\models\Categorie;
use catawich\models\Taille;

//------1------
//pour la catégorie dont le nom contient 'traditionnel', 
//lister les sandwichs dont le type_pain contient 'baguette',

$sands1 = Sandwich::with('categories')->whereHas('categories',function($c){
                    $c->where('nom','=','traditionnel');
                })->where('type_pain','=','baguette')->get();

echo "\n-----------------------ex1---------------------------- \n\n";

foreach ($sands1 as $s) {
    echo "\n ---------------sand---------------- \n";
    echo "nom : ".$s->nom . " \n";
    echo "type_pain : ".$s->type_pain . " \n";
        foreach($s->categories as $cat){
                echo "\n ------cat----- \n";
                echo "nom cat: ".$cat->nom . " \n";
            }
}
echo "\n\n";

//------2------
//pour le sandwich d'ID 5, 
//lister les images de type 'image/jpeg' et de def_X > 720,

$imgs1 = Image::with('sandwich')->whereHas('sandwich',function($s){
                            $s->where('id','=',5);
                    })->where('def_x','>',720)->get();

echo "\n-----------------------ex2---------------------------- \n\n";

foreach ($imgs1 as $i) {
    echo "\n---------------img---------------- \n";
    echo "filename : ".$i->filename . " \n";
    echo "def_X : ".$i->def_x . " \n";
    echo "------sand----- \n";
    echo "id sand: ".$i->sandwich->id . " \n";
       
}

echo "\n\n";


//------3------
//lister les sandwichs qui ont plus de 4 images associées,

$sandwichs4 = Sandwich::with('images')->has('images','>',6)->get();

echo "\n-----------------------ex3---------------------------- \n\n";

foreach ($sandwichs4 as $s) {
    echo "\n---------------sand---------------- \n";
    echo "nom : ".$s->nom . " \n";
    echo "type_pain : ".$s->type_pain . " \n";
        foreach($s->images as $i){
                echo "\n ------img----- \n";
                echo "nom img: ".$i->filename . " \n";
            }
}
echo "\n\n";

//------4------ 
//lister les catégories qui ont plus de 6 images associées,


            //------------method1 :

// $cats6 = Categorie::whereHas('sandwichs',function($s){
//                     $s->has('images','>',6);
//             })->get();

// echo "\n-----------------------ex4---------------------------- \n\n";

// foreach ($cats6 as $c) {
//     echo "\n---------------cat---------------- \n";
//     echo "nom : ".$c->nom . " \n";
// }

            //-----------method2 :

$cats6 = Categorie::Has('sandwichs.images','>',6)->get();

echo "\n-----------------------ex4---------------------------- \n\n";

foreach ($cats6 as $c) {
echo "\n---------------cat---------------- \n";
echo "nom : ".$c->nom . " \n";
}
echo "\n\n";

//------5------
//lister les catégories qui contiennent des sandwichs dont le type de pain est 'baguette'

$cats7 = Categorie::whereHas('sandwichs',function($s){
                    $s->where('type_pain','=','baguette');
            })->get();

echo "\n-----------------------ex5---------------------------- \n\n";

foreach ($cats7 as $c) {
    echo "\n---------------cat---------------- \n";
    echo "nom : ".$c->nom . " \n";
        foreach($c->sandwichs as $s){
                echo "\n ------sand----- \n";
                echo "nom : ".$s->nom . " \n";
                echo "type_pain : ".$s->type_pain . " \n";
            }
}
echo "\n\n";

//------6------
//lister les sandwichs qui possèdent des images de types 'image/jpeg' de taille > 18000

$sands6 = Sandwich::with('images')->whereHas('images',function($i){
        $i->where('type','=','image/jpeg')->where('taille','>',18000);
})->get();

echo "\n-----------------------ex6---------------------------- \n\n";

foreach ($sands6 as $s) {
    echo "\n---------------sand---------------- \n";
    echo "nom : ".$s->nom . " \n";
        foreach($s->images as $i){
                echo "\n ------img----- \n";
                echo "nom img: ".$i->filename . " \n";
                echo "type img: ".$i->type . " \n";
                echo "taille img: ".$i->taille . " \n";
            }
}
echo "\n\n";


//------7------
//lister les catégories qui possèdent des images de types 'image/jpeg' de taille > 18000

$cats77 = Categorie::with('sandwichs')->whereHas('sandwichs',function($s){
    $s->whereHas('images',function($i){
        $i->where('type','=','image/jpeg')->where('taille','>',18000);
    });
})->get();

echo "\n-----------------------ex7---------------------------- \n\n";

foreach ($cats77 as $c) {
    echo "\n---------------cat---------------- \n";
    echo "nom : ".$c->nom . " \n";
    foreach($c->sandwichs as $s){
        echo "\n ------sand----- \n";
        echo "nom : ".$s->nom . " \n";
        echo "type_pain : ".$s->type_pain . " \n";
    }
}
echo "\n\n";


//------8------
//lister les sandwichs qui possèdent des images de types 'image/jpeg' 
//de taille > 18000 et qui sont de catégorie 'traditionnel',

$sands8 = Sandwich::with('images','categories')->whereHas('images',function($i){
        $i->where('type','=','image/jpeg')->where('taille','>',18000);
})->whereHas('categories',function($c){
    $c->where('nom','=','traditionnel');
})->get();

echo "\n-----------------------ex8---------------------------- \n\n";

foreach ($sands8 as $s) {
    echo "\n---------------sand---------------- \n";
    echo "nom : ".$s->nom . " \n";
        foreach($s->images as $i){
                echo "\n ------img----- \n";
                echo "nom img: ".$i->filename . " \n";
                echo "type img: ".$i->type . " \n";
                echo "taille img: ".$i->taille . " \n";
            }
        foreach($s->categories as $c){
            echo "\n ------cat----- \n";
            echo "nom cat: ".$c->nom . " \n";
        }
}
echo "\n\n";



//------9------
//pour le sandwich d'ID 7, lister les tailles pour lequel il est disponible avec un prix < 7.0

$sand9 = Sandwich::with(array('tailles' => function($t)
{
    $t->wherePivot('prix', '<', 7);
}))->find(7);

echo "\n-----------------------ex9---------------------------- \n\n";

foreach ($sand9->tailles as $t) {
    echo "\n---------------taille---------------- \n";
    echo "nom : ".$t->nom . " \n";
}


echo "\n\n";












?>