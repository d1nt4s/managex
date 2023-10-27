<?php

$days_week = [
  "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
];

if (isset($_COOKIE['timetable'])) {
  for ($i = 0; $i < count($days_week); $i++)
  {
    $timetable[lcfirst($days_week[$i])] = unserialize($_COOKIE[lcfirst($days_week[$i])]);
  }
}

if (isset($_POST['data'])) {
  $data = json_decode($_POST['data'], true);
  for ($i = 0; $i < count($days_week); $i++)
  {
    setcookie(lcfirst($days_week[$i]), serialize($data[lcfirst($days_week[$i])]));
  }
}

// print_arr($timetable);