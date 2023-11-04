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
  $GLOBALS['timetable'] = [
    'monday' => [
      0 => 'Buisness 1',
      1 => 3,
      2 => 'Buisness 2',
      3 => 3,
      4 => 'Buisness 3',
      5 => 3,
      6 => '18:00',
      7 => '7h30',
      8 => 3,
    ],
    'tuesday' => [
      0 => 'Buisness 1',
      1 => 3,
      2 => 'Buisness 2',
      3 => 3,
      4 => 'Buisness 3',
      5 => 3,
      6 => '18:00',
      7 => '7h30',
      8 => 3,
    ],
    'wednesday' => [
      0 => 'Buisness 1',
      1 => 3,
      2 => 'Buisness 2',
      3 => 3,
      4 => 'Buisness 3',
      5 => 3,
      6 => '18:00',
      7 => '7h30',
      8 => 3,
    ],
    'thursday' => [
      0 => 'Buisness 1',
      1 => 3,
      2 => 'Buisness 2',
      3 => 3,
      4 => 'Buisness 3',
      5 => 3,
      6 => '18:00',
      7 => '7h30',
      8 => 3,
    ],
    'friday' => [
      0 => 'Buisness 1',
      1 => 3,
      2 => 'Buisness 2',
      3 => 3,
      4 => 'Buisness 3',
      5 => 3,
      6 => '18:00',
      7 => '7h30',
      8 => 3,
    ],
    'saturday' => [
      0 => 'Buisness 1',
      1 => 3,
      2 => 'Buisness 2',
      3 => 3,
      4 => 'Buisness 3',
      5 => 3,
      6 => '18:00',
      7 => '7h30',
      8 => 3,
    ],
    'sunday' => [
      0 => 'Buisness 1',
      1 => 3,
      2 => 'Buisness 2',
      3 => 3,
      4 => 'Buisness 3',
      5 => 3,
      6 => '18:00',
      7 => '7h30',
      8 => 3,
    ],
  ];
}

if (isset($_POST['data'])) {
  $data = json_decode($_POST['data'], true);
  setcookie('timetable', 'exist');
  for ($i = 0; $i < count($days_week); $i++)
  {
    setcookie (lcfirst($days_week[$i]), "", time() - 3600);
    setcookie(lcfirst($days_week[$i]), serialize($data[lcfirst($days_week[$i])]));
  }
}
