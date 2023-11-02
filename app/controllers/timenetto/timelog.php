<?php

require_once('joint_funcs.php');

/* ВЫВОД ЗНАЧЕНИЙ */

function showDayLog($day) : array {

  $output = array();
  $output = getDayLog($day);

  if ($output[0] !== 'No data') {
    for ($i = 0; $i < count($output); $i++) {
      $output[$i] = decorateOutput($output[$i]);
    }
  }

  return $output;
}

function decorateOutput($output)
{
  $output = substr($output, 16);
  $output = substr_replace($output, '', 5, 3);
  $output = substr_replace($output, '', 11, 3);
  $output = substr_replace($output, ' --> ', 5, 0);
  return $output;
}

/* ВВОД ЗНАЧЕНИЙ */
function changeDateView($date)
{
  $res = $date[0];
  $str = substr($date[1], 16, 8);
  $res = $res . " " . $str . " " . $date[2];
  return $res; 
}

function setDayLog($data)
{

  $year = substr($data,11,4);
  $month = substr($data, 4, 3);
  $file_name = lcfirst(substr($data, 0, 3)) . substr($data, 8, 2);

  // Проверка --> Создание папки "year"  
  if (!is_dir(DATA . "/{$year}")) {
    if (!mkdir(DATA . "/{$year}", 0777, false)) {
      die("Не удалось создать директорию {$year}");
    }
  }

  // Проверка --> Создание папки "month"  
  if (!is_dir(DATA . "/{$year}/{$month}")) {
    if (!mkdir(DATA . "/{$year}/{$month}", 0777, false)) {
      die("Не удалось создать директорию {$month}");
    }
  }

  $path_to_file = DATA . "/{$year}/{$month}";

  $file = fopen($path_to_file . "/{$file_name}", 'a') or die("Не удалось создать файл {$file_name}");
  fwrite($file, $data . PHP_EOL);
  fclose($file);

}