
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

            // console.log(date.toLocaleDateString('en-CA'));
            for (const key in yourList) {
                let D = date.toLocaleDateString('en-CA')
                let H = hhh +':00';
                if (key, yourList[key].heure == H && (key, yourList[key].jour == D)) {
                    hourElem.style.pointerEvents = 'none';
                    hourElem.style.opacity = '0.6';
                    hourElem.style.backgroundColor = '#cccccc';
                    hourElem.style.color = '#666666';
                    // console.log(key, yourList);
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

  let form = document.getElementById("exampleForm");
  form.onsubmit = function(event) {
    event.preventDefault(); // Empêche la soumission du formulaire
    modal.style.display = "block"; // Affiche le modal
}

  document.addEventListener('DOMContentLoaded', () => {
    // Get modal elements
    const loginModal = document.getElementById('loginModal');
    const signupModal = document.getElementById('signupModal');

    // Get button elements
    const loginButton = document.getElementById('loginButton');
    const signupButton = document.getElementById('signupButton');

    // Get close elements
    const closeLoginModal = document.getElementById('closeLoginModal');
    const closeSignupModal = document.getElementById('closeSignupModal');

    // Open modals
    loginButton.addEventListener('click', () => {
        loginModal.style.display = 'block';
    });

    signupButton.addEventListener('click', () => {
        signupModal.style.display = 'block';
    });

    // Close modals
    closeLoginModal.addEventListener('click', () => {
        loginModal.style.display = 'none';
    });

    closeSignupModal.addEventListener('click', () => {
        signupModal.style.display = 'none';
    });

    // Close modals when clicking outside of them
    window.addEventListener('click', (event) => {
        if (event.target == loginModal) {
            loginModal.style.display = 'none';
        }
        if (event.target == signupModal) {
            signupModal.style.display = 'none';
        }
    });
});


