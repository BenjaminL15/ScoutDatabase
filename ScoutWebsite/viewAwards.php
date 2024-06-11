<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awards Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>Awards Details</header>
        <div class="awards-info">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for an award...">
                <button onclick="searchAward()">Search</button>
            </div>
            <h2>Awards Information</h2>
            <!-- Placeholder for awards data -->
            <p class="placeholder">This is placeholder data until the database is ready.</p>

            <!-- Table to display awards and scouts -->
            <table>
                <tr>
                    <th>Award</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date Achieved</th>
                </tr>
                <!-- Placeholder data -->
                <tr>
                    <td class="placeholder">Eagle Scout</td>
                    <td class="placeholder">Ben</td>
                    <td class="placeholder">Lee</td>
                    <td class="placeholder">2023-05-12</td>
                </tr>
                <tr>
                    <td class="placeholder">Life Scout</td>
                    <td class="placeholder">Brian</td>
                    <td class="placeholder">Lai</td>
                    <td class="placeholder">2023-10-15</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="viewAwards.js"></script>
    <div class="viewBackground"></div>
</body>

</html>
