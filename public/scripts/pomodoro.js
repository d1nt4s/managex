import { Pomodoro } from "./PomodoroClass.js";


let pomodoro = new Pomodoro(getStages());

document.getElementById('start').addEventListener('click', () => {
  pomodoro.interval = setInterval(updateTime, 1000); 
  pomodoro.startStage();
});

document.getElementById('pause').addEventListener('click', () => {
  pomodoro.pauseStage();
});

document.getElementById('set').addEventListener('click', () => {
  pomodoro = new Pomodoro(getStages());
});

function updateTime()
{
  pomodoro.Stage();
}

function getStages()
{
  const stages = new Map();
  let features = document.getElementsByClassName("pomodoro-feature"); 

  reloadStagesPHP({
    'session':features[0].value, 
    'short_break':features[1].value, 
    'long_break':features[2].value, 
    'long_break_interval':features[3].value}
  );

  stages.set('session', features[0].value);
  stages.set('short_break', features[1].value);
  stages.set('long_break', features[2].value);
  stages.set('long_break_interval', features[3].value);
  return stages;
}

function reloadStagesPHP(stages)
{
  stages = JSON.stringify(stages);

  $.ajax({
    type:'POST',
    url:'pomodoro',
    data:{
      stages
    },
    success:function(data){
      console.log(data)
    }
  });

}