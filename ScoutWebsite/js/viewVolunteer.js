function searchVolunteer() {
    const input = document.getElementById("searchInput").value.trim().toLowerCase();
    const table = document.getElementById("volunteerTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { 
        const cells = rows[i].getElementsByTagName("td");
        let found = false;

        const volunteerFirstName = cells[0].innerText.trim().toLowerCase();
        const volunteerLastName = cells[1].innerText.trim().toLowerCase();

        if (input === "") {
            rows[i].style.display = ""; 
            continue;
        }

        const inputParts = input.split(' ');
        const firstName = inputParts[0];
        const lastName = inputParts.slice(1).join(' ');

        if ((firstName && volunteerFirstName.includes(firstName)) ||
            (lastName && volunteerLastName.includes(lastName))) {
            found = true;
        }

        if (found) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

function openVolunteerModal(volunteerID, firstName, lastName, phone, address, state, zip) {
    document.getElementById('editVolunteerId').value = volunteerID;
    document.getElementById('editFirstName').value = firstName;
    document.getElementById('editLastName').value = lastName;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editAddress').value = address;
    document.getElementById('editState').value = state;
    document.getElementById('editZIP').value = zip;
    document.getElementById('editModal').style.display = 'block';
}

function closeVolunteerModal() {
    document.getElementById('editModal').style.display = 'none';
}

let deleteVolunteerID = null;

function confirmDeleteVolunteer(volunteerID) {
    deleteVolunteerID = volunteerID;
    document.getElementById('confirmPopupOverlay').style.display = 'block';
    document.getElementById('confirmPopup').style.display = 'block';
}

function closeConfirmPopup() {
    deleteVolunteerID = null;
    document.getElementById('confirmPopupOverlay').style.display = 'none';
    document.getElementById('confirmPopup').style.display = 'none';
}

function deleteVolunteer() {
    if (deleteVolunteerID !== null) {
        fetch('deleteVolunteer.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'volunteerId=' + encodeURIComponent(deleteVolunteerID),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            closeConfirmPopup();
            if (data === 'Success') {
                showPopup('Volunteer successfully deleted!');
                document.getElementById('volunteerTable').querySelector(`tr[data-volunteer-id="${deleteVolunteerID}"]`).remove();
            } else {
                alert('Failed to delete volunteer.');
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }
}

function showPopup(message) {
    document.getElementById('popupOverlay').style.display = 'block';
    var popup = document.getElementById('popup');
    popup.querySelector('p').textContent = message;
    popup.style.display = 'block';
}

function closePopup() {
    window.location.href = 'welcomePage.php';
}

function refreshPage() {
    window.location.reload();
}


searchInput.addEventListener('keyup', searchVolunteer);
dateInput.addEventListener('change', searchVolunteer);