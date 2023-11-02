<?php

function getDayLog($day) : array {

  $year = date('Y');
  $month = substr(date('F'), 0, 3);
  $file_name = lcfirst(substr($day, 0, 3)) . "0" . substr(date('jS'), 0, -2);;
// BUG(ershov): Может быть неправильный вывод у date('jS'), вследствие чего $file_name будет неправильным

  if (file_exists(DATA . "/{$year}/{$month}/{$file_name}"))
  {
    $file = fopen(DATA . "/{$year}/{$month}/{$file_name}", "r");
  }
  else return(["No data"]);
 
  $out = [];
  $i = 0;
  if($file) {
    while (($line = fgets($file)) !== false) {
      $out[$i++] = $line;
    }
  }
  
  fclose($file);
  return $out;
}