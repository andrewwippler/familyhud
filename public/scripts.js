async function getApi(url='') {
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function renderFamily() {
    let family = await getApi('/api/family.php');
    let html = '';
    family.forEach(member => {
        let htmlSegment = `<div class="family"><span class="dot ${(member.can_call) ? 'green' : 'red'}"></span><span class="family-name">${member.name}</span></div>`;

        html += htmlSegment;
    });

    let familyContainer = document.querySelector('.family-container');
    familyContainer.innerHTML = html;
}

async function renderCalendar() {
    let calendar = await getApi('/api/calendar.php');
    let html = '';
    if (!!calendar) {
        calendar.forEach(item => {

            let htmlSegment = `<div class="calendar"><span class="item">${item.summary}</span><span class="time">${(!item.end) ? 'All Day' : item.start}</span></div>`;
            html += htmlSegment;

        });
    } else {
        html = `<div>No events for today.</div>`;
    }
    

    let calContainer = document.querySelector('.calendar-container');
    calContainer.innerHTML = html;
}

// run on page load (once a day)
renderCalendar();
renderFamily();

// const interval = setInterval(function() {
//     renderFamily();
// }, 60000); // every minute

const reloadPageInterval = setInterval(function() {
    window.location.reload(); 
}, 86400000); // one day in ms