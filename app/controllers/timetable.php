<?php

$GLOBALS['days_week'] = [
  "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
];
$days_week = $GLOBALS['days_week'];

if (isset($_COOKIE['timetable'])) {
  for ($i = 0; $i < count($days_week); $i++)
  {
    $timetable[lcfirst($days_week[$i])] = unserialize($_COOKIE[lcfirst($days_week[$i])]);
  }
  $GLOBALS['timetable'] = $timetable;
}

if (isset($_POST['data'])) {
  $data = json_decode($_POST['data'], true);
  for ($i = 0; $i < count($days_week); $i++)
  {
    setcookie(lcfirst($days_week[$i]), serialize($data[lcfirst($days_week[$i])]));
  }
}
