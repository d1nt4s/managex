<?php

require_once('timelog.php');
require_once('time_analyze.php');

// Получение информации о сессиях из pomodoro
if (isset($_POST['pomodoro_stage_data'])) {
  $data = json_decode($_POST['pomodoro_stage_data'], true);
  setDayLog(changeDateView($data));
}
