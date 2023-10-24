export class Pomodoro
{
  timer;
  seconds = 0;
  minutes;
  interval;
  switcher = false;

  constructor (minutes)
  {
    this.minutes = minutes;
    this.timer = document.getElementById('timer');
    this.timer.innerHTML = minutes + ':00';
  }

  updateTime()
  {
    if (this.minutes == 0 && this.seconds == 0) {
      alert("GO EAT");
      clearInterval(this.interval);
      if (this.switcher == false) {
        this.switcher = true;
        // Информация о пройденной сессии записывается
      }
      if (this.switcher == true) {
        this.switcher = false;
        // Информация о пройденном перерыве записывается
      }
    }
    if (this.seconds == 0) {
      this.minutes--;
      this.seconds = 60;
    }
    this.seconds--;

    this.timer.textContent = `${this.minutes.toString()}:${this.seconds.toString().padStart(2, '0')}`;
  }

}