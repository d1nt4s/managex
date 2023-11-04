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
} else {
  for ($i = 0; $i < count($days_week); $i++)
  {
    $_SESSION['timetable'][lcfirst($days_week[$i])] = [
      'first_business_name' => 'Buisness 1',
      'first_business_lasting' => 3,
      'second_business_name' => 'Buisness 2',
      'second_business_lasting' => 3,
      'third_business_name' => 'Buisness 3',
      'third_business_lasting' => 3,
      'fourth_business_name' => 'Buisness 4',
      'fourth_business_lasting' => 3,
      'fifth_business_name' => 'Buisness 5',
      'fifth_business_lasting' => 3,
      'sixth_business_name' => 'Buisness 6',
      'sixth_business_lasting' => 3,
      'finish_time' => '18:00',
      'day_lasting' => '7h30',
      'count_business' => 3,
    ];
  }
}

if (isset($_POST['data'])) {
  $data = json_decode($_POST['data'], true);

  $keys = ['first_business_name', 'first_business_lasting', 'second_business_name', 'second_business_lasting', 'third_business_name', 'third_business_lasting', 'fourth_business_name', 'fourth_business_lasting', 'fifth_business_name', 'fifth_business_lasting', 'sixth_business_name', 'sixth_business_lasting','finish_time','day_lasting','count_business'];
  for ($i = 0; $i < count($days_week); $i++)
  {
    $data[lcfirst($days_week[$i])] = array_combine($keys, $data[lcfirst($days_week[$i])]);
    setcookie (lcfirst($days_week[$i]), "", time() - 3600);
    setcookie(lcfirst($days_week[$i]), serialize($data[lcfirst($days_week[$i])]));
  }
  setcookie('timetable', 'exist');
}
