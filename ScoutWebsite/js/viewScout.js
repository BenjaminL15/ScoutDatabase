function searchScout() {
    const searchInput = document.getElementById('searchInput');
    const dateInput = document.getElementById('dateInput');
    const filter = searchInput.value.trim().toUpperCase();
    const dateFilter = dateInput.value.trim();
    const rows = document.querySelectorAll('#scoutTable tr');

    rows.forEach((row, index) => {
        if (index === 0) return; 
        const cells = row.getElementsByTagName('td');
        const firstName = cells[0].textContent.trim().toUpperCase();
        const lastName = cells[1].textContent.trim().toUpperCase();
        const rank = cells[2].textContent.trim().toUpperCase();
        const birthday = cells[3].textContent.trim();
        const parentFirstName = cells[4].textContent.trim().toUpperCase();
        const parentLastName = cells[5].textContent.trim().toUpperCase();
        const parentPhone = cells[6].textContent.trim();

        if ((firstName.includes(filter) || lastName.includes(filter) || rank.includes(filter) || birthday.includes(filter) || parentFirstName.includes(filter) || parentLastName.includes(filter) || parentPhone.includes(filter)) &&
            (dateFilter === '' || dateFilter === birthday)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

document.getElementById('searchInput').addEventListener('keyup', searchScout);
document.getElementById('dateInput').addEventListener('change', searchScout);
