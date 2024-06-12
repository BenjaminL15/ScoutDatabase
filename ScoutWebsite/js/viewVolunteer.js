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
            rows[i].style.display = ""; // Show all rows if the search input is empty
            continue; // Skip to the next row
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
