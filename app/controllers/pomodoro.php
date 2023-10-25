<?php

if (isset($_COOKIE['stages'])) {
  $stages = unserialize($_COOKIE['stages']);
} else {
  $stages = [
    "session" => 45,
    "short_break" => 5,
    "long_break" => 15,
    "long_break_interval" => 2,
  ];
}

if (isset($_POST['stages'])) {
  $data = json_decode($_POST['stages'], true);
  setcookie('stages', serialize($data));
}
