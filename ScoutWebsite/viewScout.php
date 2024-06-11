<?php
    require_once('db.php');
    $sql = "SELECT s.SCOUTID, s.FIRSTNAME, s.LASTNAME, s.SCOUT_RANK, s.SCOUT_BIRTHDAY, p.PARENT_FNAME, p.PARENT_LNAME, p.PARENTPHONE 
        FROM SCOUTS s 
        LEFT JOIN PARENTS p ON s.SCOUTID = p.SCOUTID
        LEFT JOIN SCOUT_PARENT sp ON s.SCOUTID = sp.SCOUTID AND p.PARENTID = sp.PARENTID
        WHERE sp.CONTACT_PRIORITY = 1";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scout Details</title>
    <link rel="stylesheet" href="style.css">
    <script src="viewScout.js"></script>
</head>

<body>
    <div class="container">
        <header>Scout Details</header>
        <div class="scout-info">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for a scout...">
                <button onclick="searchScout()">Search</button>
            </div>
            <h2>Scout Information</h2>
            <table id="scoutTable">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Rank</th>
                    <th>Birthday</th>
                    <th>Parent's First Name</th>
                    <th>Parent's Last Name</th>
                    <th>Parent's Phone Number</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
                <?php
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>      
                    <tr>
                        <td><?php echo $row['FIRSTNAME']; ?></td>
                        <td><?php echo $row['LASTNAME']; ?></td>
                        <td><?php echo $row['SCOUT_RANK']; ?></td>
                        <td><?php echo $row['SCOUT_BIRTHDAY']; ?></td>
                        <td><?php echo $row['PARENT_FNAME']; ?></td>
                        <td><?php echo $row['PARENT_LNAME']; ?></td>
                        <td><?php echo $row['PARENTPHONE']; ?></td>
                        <td>
                        <button class="edit-btn" onclick="editScout(<?php echo $row['SCOUTID']; ?>)">Edit</button>
                        <button class="delete-btn" onclick="deleteScout(<?php echo $row['SCOUTID']; ?>)">Delete</button>

                        </td>
                    </tr>
                <?php
                    }  
                    mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
    <div class="viewBackground"></div>
</body>

</html>
