<?php

require_once('funcs.php');

function analyzeDay($day)
{

  $daylog = getDayLog($day);

  $stages_duration = sumStagesDuration($daylog);

  $beginning_time = getBeginningTime($daylog);
  $end_time = getEndTime($daylog);

  $days_week = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
  $timetable = $GLOBALS['timetable'][$days_week[date('w')]];

  $report = bindTimeWithEmployment($timetable, $stages_duration['session']);
  $report[count($report)] = "Work started at {$beginning_time}";
  $report[count($report)+1] = "Work ended at {$end_time}";

  return $report;
}

function bindTimeWithEmployment($employments, $working_time)
{
  $name = 0;
  $duration = 1;

  for ($count = 0; $count < $employments[count($employments) - 1]; $count++)
  {
    if ($employments[$name] != "") {

      $expected_duration = (int)((float) $employments[$duration]) * 60 * 60;

      switch (true) {
        case $expected_duration - $working_time < 0:
          $real_duration = $expected_duration;
          $working_time = $working_time - $expected_duration;
          break;
        case $expected_duration - $working_time > 0:
          $real_duration = $working_time;
          $working_time = 0;
          break;
        case $expected_duration - $working_time == 0:
          $real_duration = $working_time; 
          $working_time = 0;
          break;
      }

      $real_duration_hours = intdiv(intdiv($real_duration, 60), 60);
      $real_duration_minutes = intdiv($real_duration, 60) % 60;

      $report[$count] = "{$employments[$name]} has taken {$real_duration_hours} hours and {$real_duration_minutes} minutes";

      $name = $name + 2;
      $duration = $duration + 2;
    }
  }

  return($report);
}

function sumStagesDuration($daylog)
{

  $stages_duration = [
    'session'=> 0,
    'short_break'=> 0,
    'long_break'=> 0,
  ];

  for ($i = 0; $i < count($daylog); $i++) {

    if ($daylog[$i] === "No data")
      continue;

    $start = substr($daylog[$i],16,8);
    $int_start = (int) substr($start, 0, 2) * 60 * 60 + (int) substr($start, 3, 2) * 60 + (int) substr($start, 6, 2);
    $end = substr($daylog[$i],25,8);
    $int_end = (int) substr($end, 0, 2) * 60 * 60 + (int) substr($end, 3, 2) * 60 + (int) substr($end, 6, 2);

    if (trim(substr($daylog[$i],34,11)) === "Session") {
      $stages_duration['session'] += $int_end - $int_start;
    } elseif (trim(substr($daylog[$i],34,11)) === "Short break") {
      $stages_duration['short_break'] += $int_end - $int_start;
    } elseif (trim(substr($daylog[$i],34,11)) === "Long break") {
      $stages_duration['long_break'] += $int_end - $int_start;
    } else {
      echo "Error in sumStagesDuration()";
    }
  }

  return $stages_duration;
}

function getBeginningTime($daylog)
{
  return substr($daylog[0], 16, 5);
}

function getEndTime($daylog)
{
  return substr($daylog[count($daylog) - 1], 25, 5); 
}