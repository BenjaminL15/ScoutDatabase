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
function openModal(scoutId, firstName, lastName, rank, birthday) {
    document.getElementById('editScoutId').value = scoutId;
    document.getElementById('editFirstName').value = firstName;
    document.getElementById('editLastName').value = lastName;
    document.getElementById('editRank').value = rank;
    document.getElementById('editBirthday').value = birthday;
    document.getElementById('editModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

function deleteScout(scoutId) {
    if (confirm("Are you sure you want to delete this scout?")) {
        fetch('deleteScout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'scoutId=' + encodeURIComponent(scoutId),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            showPopup('Scout successfully deleted!');
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }
}

function showPopup() {
    document.getElementById('popupOverlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    window.location.href = 'welcomePage.php';
}

function refreshPage() {
    window.location.reload();
}
document.getElementById('searchInput').addEventListener('keyup', searchScout);
document.getElementById('dateInput').addEventListener('change', searchScout);
