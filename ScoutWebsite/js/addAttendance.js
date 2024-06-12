function searchScouts() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#scoutsTable tr:not(:first-child)");
    rows.forEach(row => {
        const firstName = row.cells[0].textContent.toLowerCase();
        const lastName = row.cells[1].textContent.toLowerCase();
        if (firstName.includes(input) || lastName.includes(input)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

searchInput.addEventListener('keyup', searchScouts);