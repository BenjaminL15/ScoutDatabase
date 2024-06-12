function searchAward() {
    const input = document.getElementById("searchInput").value.trim().toLowerCase();
    const table = document.getElementById("awardsTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { 
        const cells = rows[i].getElementsByTagName("td");
        let found = false;

        if (cells.length > 0) {
            const awardName = cells[0].innerText.toLowerCase();
            const firstName = cells[1].innerText.toLowerCase();
            const lastName = cells[2].innerText.toLowerCase();

            if (awardName.includes(input) || firstName.includes(input) || lastName.includes(input)) {
                found = true;
            }

            if (found) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}
