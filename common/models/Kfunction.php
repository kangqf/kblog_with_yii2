<?php
namespace common\models;

    class Kfunction
    {
      
      public function array_foreach ($arr) 
      {
        if (!is_array ($arr)) 
        {
          return false;
        }
        
        foreach ($arr as $key => $val ) 
        {
          if (is_array ($val)) 
          {
            array_foreach ($val);
          } 
          else 
          {
            echo $key.'=>'.$val.'<br/>';
          }
        }
      }
    }  

  
  ?>