(function () {
  //!------------------: START
  
const elemAll = document.querySelectorAll('.action textarea');

[...elemAll].forEach(elem => {
	elem.style.height = `${elem.style.scrollHeight}px`;
	elem.addEventListener("input", OnInput, false);
});

function OnInput() {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
}

  //!------------------: STOP
})();

document.getElementById('set_timetable').addEventListener('click', () => {
  sortData();
});

document.getElementById('clear_timetable').addEventListener('click', () => {
  // if (confirm("Are you sure to clear timetable?") == false)
  //   return;
  clearTimetable();
});

function sortData()
{
  let data = {}

  let days_week = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
  let day = [];

  // console.log(document.querySelectorAll('.action.monday').length);

  for (let i = 0; i < days_week.length; i++)
  {

    day[0] = document.getElementsByClassName('action ' + days_week[i] + ' row1')[0].firstChild.value; 
    day[1] = document.getElementsByClassName('duration ' + days_week[i] + ' row1')[0].firstChild.value; 
    day[2] = document.getElementsByClassName('action ' + days_week[i] + ' row2')[0].firstChild.value; 
    day[3] = document.getElementsByClassName('duration ' + days_week[i] + ' row2')[0].firstChild.value; 
    day[4] = document.getElementsByClassName('action ' + days_week[i] + ' row3')[0].firstChild.value; 
    day[5] = document.getElementsByClassName('duration ' + days_week[i] + ' row3')[0].firstChild.value; 
    day[6] = document.getElementsByClassName('duration time ' + days_week[i] + ' row4')[0].firstChild.value; 
    day[7] = document.getElementsByClassName('duration day ' + days_week[i] + ' row5')[0].firstChild.value; 
    day[8] = document.querySelectorAll('.action.monday').length;

    data[days_week[i]] = day;    
    day = [];
    console.log(data[days_week[i]]);
  }

  sendTimetable(data);

}

function sendTimetable(data)
{
  data = JSON.stringify(data);

  $.ajax({
    type:'POST',
    url:'timetable',
    data:{
      data
    },
    success:function(data){
      console.log(data)
    }
  });

  console.log(data);

}

function clearTimetable()
{
  let childNodes = document.getElementsByClassName('timetable-body')[0].childNodes;

  [].forEach.call(childNodes, function(tr) {
    if (tr.nodeName == "TR")
      [].forEach.call(tr.childNodes, function(td) { 
        if (td.nodeName == "TD" && td.firstChild.nodeName != "#text") {
          td.firstChild.value = "";
        }
      });
  });
}