<?php
    require_once('db.php');
    $sql = "SELECT AWARDS.AWARD_NAME, SCOUTS.FIRSTNAME, SCOUTS.LASTNAME, MEMBER_AWARDS.DATE_EARNED 
        FROM MEMBER_AWARDS 
        JOIN SCOUTS ON MEMBER_AWARDS.SCOUTID = SCOUTS.SCOUTID 
        JOIN AWARDS ON MEMBER_AWARDS.AWARDID = AWARDS.AWARDID";
    $result = mysqli_query($conn, $sql);
?>

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
            <!-- Table to display awards and scouts -->
            <table id="awardsTable">
                <tr>
                    <th>Award</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date Achieved</th>
                </tr>
                <?php
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>      
                    <td><?php echo $row['AWARD_NAME']; ?></td>
                    <td><?php echo $row['FIRSTNAME']; ?></td>
                    <td><?php echo $row['LASTNAME']; ?></td>
                    <td><?php echo $row['DATE_EARNED']; ?></td>
                </tr>
                <?php
                    }  mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
    <script src="viewAwards.js"></script>
    <div class="viewBackground"></div>
</body>

</html>
