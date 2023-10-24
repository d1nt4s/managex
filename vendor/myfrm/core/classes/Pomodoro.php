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


}