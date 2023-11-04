<?php

function getDayLog($day) : array {

  $number = (string)(getMonthNumber($day));

  if ((int)$number <= 0) {
    return ["No data"];
  }

  if (strlen($number) == 1) {
    $number = "0" . $number;
  }

  $year = date('Y');
  $month = substr(date('F'), 0, 3);
  $file_name = lcfirst(substr($day, 0, 3)) . $number;

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

function getMonthNumber($current_day_name)
{
  $d_w = [0 =>'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday']; 

  $actual_day_num = substr(date('jS'), 0, -2);
  $actual_day_index = date('w');

  for ($i = 0; $i < count($d_w); $i++) {
    if ($d_w[$i] == $current_day_name) {

      if ($i == 0)
        $i = 7; /* Из-за того, что в Sunday стоит в самом начале массива, что ломает логику дней недели */

      if ($i > $actual_day_index) {
        return $actual_day_num + ($i - $actual_day_index);
      } else if ($i < $actual_day_index) {
        return $actual_day_num - ($actual_day_index - $i);
      } else {
        return (int)$actual_day_num;
      }
    }
  }
}