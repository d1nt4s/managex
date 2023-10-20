<?php

namespace myfrm;

class Pomodoro
{

  public int $sessions_count;
  public int $breaks_count;

  // $switcher : false - start session
  // $switcher : true - start break
  protected bool $switcher = false;


  public function __construct()
  {
  }

  // public function start()
  // {
  //   $w = new EvPeriodic(0., 10.5, NULL, function ($w, $revents) {
  //     echo time(), PHP_EOL;
  //   });
    
  //   Ev::run();
  // }

}