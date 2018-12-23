<?php
namespace catawich\models;

class Image extends \Illuminate\Database\Eloquent\Model {

       protected $table      = 'image';  
       protected $primaryKey = 'id';     
       public    $timestamps = false;  


       //
       public function sandwich()
       {
           return $this->belongsTo('catawich\models\Sandwich', 's_id');
       }



}

?>