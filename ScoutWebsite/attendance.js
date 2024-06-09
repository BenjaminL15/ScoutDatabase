function toggleDatabaseView() {
    var dbView = document.getElementById('databaseView');
    if (dbView.style.display === 'none') {
        dbView.style.display = 'block';
    } else {
        dbView.style.display = 'none';
    }
}