function searchScout() {
    const input = document.getElementById("searchInput").value.trim().toLowerCase();
    const table = document.getElementById("scoutTable");
    const rows = table.getElementsByTagName("tr");

    let firstName = '';
    let lastName = '';
    let rank = '';

    const inputParts = input.includes(' ') ? input.split(' ') : [input];
    
    if (inputParts.length > 1) {
        firstName = inputParts[0];
        lastName = inputParts.slice(1).join(' '); 
    } else {
        firstName = inputParts[0];
    }

    for (let i = 1; i < rows.length; i++) { 
        const cells = rows[i].getElementsByTagName("td");
        let found = false;

        const scoutFirstName = cells[0].innerText.toLowerCase();
        const scoutLastName = cells[1].innerText.toLowerCase();
        const scoutRank = cells[2].innerText.toLowerCase();

        if ((firstName && scoutFirstName.includes(firstName)) ||
            (lastName && scoutLastName.includes(lastName)) ||
            (inputParts.length === 1 && scoutRank.includes(inputParts[0]))) {
            found = true;
        }

        if (found) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}


document.addEventListener("DOMContentLoaded", function() {
    const scoutTable = document.getElementById("scoutTable");

    scouts.forEach(scout => {
        const row = scoutTable.insertRow();
        row.insertCell(0).textContent = scout.FIRSTNAME;
        row.insertCell(1).textContent = scout.LASTNAME;
        row.insertCell(2).textContent = scout.SCOUT_RANK;
        row.insertCell(3).textContent = scout.SCOUT_BIRTHDAY;
        row.insertCell(4).textContent = scout.PARENT_FNAME;
        row.insertCell(5).textContent = scout.PARENT_LNAME;
        row.insertCell(6).textContent = scout.PARENTPHONE;
    });
});



