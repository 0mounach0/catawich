<?php
require_once 'Header.php';

//-------6. Soft Deletes -----------
use catawich\models\Sandwich;


$sand1 = Sandwich::find(10);

$sand1->delete();

$sandwichs = Sandwich::select()->get();

echo "\n -------not deleted sandwichs----- \n";

foreach($sandwichs as $s){
    echo "\n ------------ \n";
    echo "id : ".$s->id . " \n";
}


$sandwichsAll = Sandwich::withTrashed()->get();

echo "\n -------All sandwichs with trashed----- \n";

foreach($sandwichsAll as $s){
    echo "\n ------------ \n";
    echo "id : ".$s->id . " \n";
}



$sandwichsTrashed = Sandwich::onlyTrashed()->get();

echo "\n -------deleted sandwichs----- \n";
foreach($sandwichsTrashed as $s){
    echo "\n ------------ \n";
    echo "id : ".$s->id . " \n";
}


?>