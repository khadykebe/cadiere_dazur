
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendrier Espace Santé La cadiére d'Azur</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('style/style.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>





    <div class="calendar">
        <button id="prevWeek">Précédent</button>
        <button id="nextWeek">Suivant</button>
        <div class="week">
          <!-- Les jours seront générés dynami  quement par JavaScript -->
        </div>
      </div>
      <script>
        var yourList = {!! $jsonList !!};
        // console.log(yourList);



document.addEventListener("DOMContentLoaded", function() {
    const daysContainer = document.querySelector('.week');
    const selectedDateElem = document.getElementById('selected-date');
    const selectedTimeElem = document.getElementById('selected-time');
    const prevWeekBtn = document.getElementById('prevWeek');
    const nextWeekBtn = document.getElementById('nextWeek');




    const hours = ['08:15','08:30','08:45',
                    '09:00','09:15','09:30','09:45',
                    '10:00','10:15','10:30','10:45',
                    '11:00','11:15','11:30','11:45',
                    '12:00','12:15','13:30','13:45',
                    '14:00','14:15','14:30','14:45',
                    '15:00','15:15','15:30','15:45',
                    '16:00','16:15','16:30','16:45',
                    '17:00','17:15','17:30','17:45',
                    '18:00','18:15',
    ];



    let currentWeekStart = new Date();

    function getWeekDays(startDate) {
      const days = [];
      for (let i = 0; i < 7; i++) {
        const date = new Date(startDate);
        date.setDate(startDate.getDate() + i);
        days.push(date);
      }
      return days;
    }

    function renderWeek(startDate) {
      daysContainer.innerHTML = '';
      const weekDays = getWeekDays(startDate);
      weekDays.forEach(date => {
        const dayElem = document.createElement('div');
        dayElem.className = 'day';


        const dayInfo = document.createElement('div');
        const tttt = date.toLocaleDateString('fr-FR', { weekday: 'long' });
        dayInfo.innerText = `${date.toLocaleDateString('fr-FR', { weekday: 'long' })} ${date.toLocaleDateString('fr-FR')}`;
        // if(tttt == "samedi" || tttt == "dimanche"){
        //     dayInfo.style.display = 'lightcoral';
        // }

        const hoursContainer = document.createElement('div');
        hoursContainer.className = 'hours';
        hours.forEach(hour => {
          const hourElem = document.createElement('div');
          hourElem.className = 'hour';
          hourElem.innerText = hour;
          const hhh = hour;

            console.log(date.toLocaleDateString('en-CA'));
            for (const key in yourList) {
                let D = date.toLocaleDateString('en-CA')
                let H = hhh +':00';
                if (key, yourList[key].heure == H && (key, yourList[key].jour == D)) {
                    hourElem.style.pointerEvents = 'none';
                    hourElem.style.opacity = '0.6';
                    hourElem.style.backgroundColor = '#cccccc';
                    hourElem.style.color = '#666666';
                    // console.log(key, yourList[key].jour);
                }
            }


          if(tttt == "samedi" || tttt == "dimanche" || tttt == "lundi"){
            // dayInfo.style.display = 'none';
            hourElem.style.pointerEvents = 'none';
            hourElem.style.opacity = '0.6';
            hourElem.style.backgroundColor = '#cccccc';
            hourElem.style.color = '#666666';
        }

        if(tttt == 'mardi' && (hhh == '13:30'|| hhh == '13:45'||hhh == '14:00'||hhh == '14:15'||hhh == '14:30'||hhh == '14:45'||hhh == '15:00'||hhh == '15:15'||hhh == '15:30'||hhh == '15:45'||hhh == '16:00'||hhh == '16:15'||hhh == '16:30'||hhh == '16:45'||hhh == '17:00'||hhh == '17:15'||hhh == '17:30'||hhh == '17:45'||hhh == '18:00'||hhh == '18:15')){
            hourElem.style.pointerEvents = 'none';
            hourElem.style.opacity = '0.6';
            hourElem.style.backgroundColor = '#cccccc';
            hourElem.style.color = '#666666';
        }

        if(tttt == 'mercredi' && (hhh == '13:30'|| hhh == '13:45'||hhh == '14:00'||hhh == '14:15'||hhh == '14:30'||hhh == '14:45'||hhh == '15:00'||hhh == '15:15'||hhh == '15:30'||hhh == '15:45'||hhh == '16:00'||hhh == '16:15'||hhh == '16:30'||hhh == '16:45'||hhh == '17:00'||hhh == '17:15'||hhh == '17:30'||hhh == '17:45'||hhh == '18:00'||hhh == '18:15')){
            hourElem.style.pointerEvents = 'none';
            hourElem.style.opacity = '0.6';
            hourElem.style.backgroundColor = '#cccccc';
            hourElem.style.color = '#666666';
        }

          hourElem.addEventListener('click', () => {
            const text1 = date.toLocaleDateString('en-CA');
            const text2 = hour;
            let url = `/receive-data?text1=${encodeURIComponent(text1)}&text2=${encodeURIComponent(text2)}`;
            window.location.href = url;
          });

          hoursContainer.appendChild(hourElem);
        });

        dayElem.appendChild(dayInfo);
        dayElem.appendChild(hoursContainer);
        daysContainer.appendChild(dayElem);
      });
    }

    function changeWeek(offset) {
      currentWeekStart.setDate(currentWeekStart.getDate() + offset * 7);
      renderWeek(currentWeekStart);
    }

    prevWeekBtn.addEventListener('click', () => changeWeek(-1));
    nextWeekBtn.addEventListener('click', () => changeWeek(1));

    renderWeek(currentWeekStart);
  });
      </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>









