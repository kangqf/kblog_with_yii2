<?php
 function array_foreach ($arr) 
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
 ?>

<html>
<head>
  <title>rrr</title>
</head>
<body>
<h1>kblogcontroller</h1>
<p>

  <?php 

    

    echo "<h2>app</h2>";
    array_foreach(Yii::$app); 
    echo "<h2>aliases</h2>";
    array_foreach(Yii::$aliases);
    echo "<h2>classMap</h2>";
    array_foreach(Yii::$classMap);
    echo "<h2>container</h2>";
    array_foreach(Yii::$container);

  ?>



</p>
</body>
</html>