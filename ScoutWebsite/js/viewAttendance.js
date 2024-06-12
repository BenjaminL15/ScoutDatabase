const searchInput = document.getElementById('searchInput');
const dateInput = document.getElementById('dateInput');

function searchAttendance() {
    const filter = searchInput.value.trim().toUpperCase();
    const dateFilter = dateInput.value.trim();
    const rows = document.querySelectorAll('table tr');

    rows.forEach((row, index) => {
        if (index === 0) return; 
        const firstName = row.cells[0].textContent.trim().toUpperCase();
        const lastName = row.cells[1].textContent.trim().toUpperCase();
        const meetingDate = row.cells[2].textContent.trim();
        const attended = row.cells[3].textContent.trim().toUpperCase();

        if ((firstName.includes(filter) || lastName.includes(filter)) &&
            (dateFilter === '' || dateFilter === meetingDate)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

searchInput.addEventListener('keyup', searchAttendance);
dateInput.addEventListener('change', searchAttendance);
