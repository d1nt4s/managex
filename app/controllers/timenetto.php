<?php

require_once ('pomodoro.php');

if (isset($_POST['pomodoro_stage_data'])) {
  $data = json_decode($_POST['pomodoro_stage_data'], true);
  $data = dataFormatString($data);
  dataFileInput($data);
}

function defineFilename($day_week) {
  $day_num = str_replace("st", "", date('jS'));
  $day_week = lcfirst(substr($day_week, 0, 3));
  return($day_week . $day_num);
}
function dataTableOutput($file_name) : array {

  $year = date('Y');
  $month = substr(date('F'), 0, 3);

  if (file_exists(DATA . "/{$year}/{$month}/{$file_name}"))
  {
    $file = fopen(DATA . "/{$year}/{$month}/{$file_name}", "r");
  }
  else return(["No data"]);
 
  $out = [];
  $i = 0;
  if($file) {
    while (($line = fgets($file)) !== false) {
      $out[$i++] = decorateOutput($line);
      // var_dump($line, PHP_EOL);
    }
  }
  
  fclose($file);
  return $out;
}

function decorateOutput($output)
{
  $output = substr($output, 16);
  $output = substr_replace($output, '', 5, 3);
  $output = substr_replace($output, '', 11, 3);
  $output = substr_replace($output, ' --> ', 5, 0);
  return $output;
}

function dataFormatString($data)
{
  $res = $data[0];
  $str = substr($data[1], 16, 8);
  $res = $res . " " . $str . " " . $data[2];
  return $res; 
}

function dataFileInput($data)
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
  // fseek($file, 0, SEEK_END);
  fwrite($file, $data . PHP_EOL);
  fclose($file);

}