<?php
require_once 'Header.php';


//-------1. Requêtes simples -----------
use catawich\models\Categorie;
use catawich\models\Sandwich;


//------1-----
//lister les sandwichs du catalogue, 
//afficher leur nom, description, type de pain

$sandwichs1 = Sandwich::select()->get();

echo "\n-----------------------ex1---------------------------- \n";

foreach($sandwichs1 as $s){
    echo "\n ------------ \n";
    echo "nom : ".$s->nom . " \n";
    echo "description : ".$s->description . " \n";
    echo "type_pain : ".$s->type_pain . " \n";
}

//------2-----
//lister les sandwichs du catalogue, 
//afficher leur nom, description, type de pain  
//en triant selon le type_pain,

$sandwichs2 = Sandwich::select()->orderBy('type_pain','ASC')->get();

echo "\n\n-----------------------ex2---------------------------- \n";

foreach($sandwichs2 as $s){
    echo "\n ------------ \n";
    echo "nom : ".$s->nom . " \n";
    echo "description : ".$s->description . " \n";
    echo "type_pain : ".$s->type_pain . " \n";
}


//------3-----
//afficher le sandwich n° 42 s'il existe, 
//sinon afficher un message indiquant qu'il n'existe pas.
//Utiliser l'exception ModelNotFoundException.

use Illuminate\Database\Eloquent\ModelNotFoundException;

$sand1 = Sandwich::select()->find(42);

echo "\n\n-----------------------ex3---------------------------- \n";

try{

    if(isset($sand1)){
        echo "nom : ".$sand1->nom . " \n";
        echo "description : ".$sand1->description . " \n";
        echo "type_pain : ".$sand1->type_pain . " \n";
    }else{
        throw new ModelNotFoundException('Not found');
    }
    
}catch(ModelNotFoundException $ex){
    echo $ex->getMessage();
}


//------4-----
//afficher les sandwichs dont le type_pain 
//contient 'baguette', triés par type_pain

$sandwichs4 = Sandwich::select()->where('type_pain','=','baguette')
                    ->orderBy('type_pain','ASC')->get();

echo "\n\n-----------------------ex4---------------------------- \n";

foreach($sandwichs4 as $s){
    echo "\n ------------ \n";
    echo "nom : ".$s->nom . " \n";
    echo "description : ".$s->description . " \n";
    echo "type_pain : ".$s->type_pain . " \n";
}


//------5-----
//créer un nouveau sandwich et l'insérer dans la base

echo "\n\n-----------------------ex5---------------------------- \n";

$newSandwich5 = new Sandwich();
$newSandwich5->nom = 'mounach';
$newSandwich5->description = 'description de mounach';
$newSandwich5->type_pain = 'baguette';

$newSandwich5->save();

echo "new sandwich inserted ! \n\n";

?>