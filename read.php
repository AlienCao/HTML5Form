<?php
  $a = file('./test1.txt');
    foreach($a as $line => $content){
        //echo 'line '.($line + 1).':'.$content.'</br>';
        //echo strpos($content,'(答案').'</br>';
        //echo substr($content,0,strpos($content,'(答案')).'</br>';
      echo substr($content,strpos($content,'(答案')-strlen($content)).'</br>';
     // echo  substr($content,strpos($content,')A.')-strlen($content)).'</br>';
    }
?>