import { Pomodoro } from "./PomodoroClass.js";


// stages => [ session ; short_break ; long_break ; long_break_interval ]
let stages = getStages();
let pomodoro = new Pomodoro(stages.get('session'));

document.getElementById('start').addEventListener('click', () => {

  if (pomodoro.switcher == false) {
    // pomodoro.minutes = features[0].value;
  } else {
    // pomodoro.minutes = features[1].value;
  }

  pomodoro.interval = setInterval(updateTime, 1000); 
  document.getElementById('start').style.display = "none";
  document.getElementById('stop').style.display = "block";
});

document.getElementById('stop').addEventListener('click', () => {
  clearInterval(pomodoro.interval);
  document.getElementById('start').style.display = "block";
  document.getElementById('stop').style.display = "none";
});

document.getElementById('set').addEventListener('click', () => {

  stages.clear();
  stages = getStages();
  pomodoro = new Pomodoro(stages.get('session'));

});

function updateTime()
{
  pomodoro.updateTime();
}

function getStages()
{
  const stages = new Map();
  let features = document.getElementsByClassName("pomodoro-feature"); 

  reloadDataOnPHP(features);

  stages.set('session', features[0].value);
  stages.set('short_break', features[1].value);
  stages.set('long_break', features[2].value);
  stages.set('long_break_interval', features[2].value);
  return stages;
}

function reloadDataOnPHP(features)
{
  let feature, xhttp, nocache;
  let i = 0;

  while (i < features.length) {
    feature = features[i].value;
    
    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4) {
        if (this.status == 200) {
          if (this.responseText != null) {
          }
          else alert("Ошибка AJAX: Данные не получены");
        }
        else alert("Ошибка AJAX: " + this.statusText);
      }
    } 
  
    nocache = "&nocache=" + Math.random() * 1000000;
    xhttp.open("GET", "pomodoro?feature=" + feature + nocache, true);
    xhttp.send();
    i++;
  }
}