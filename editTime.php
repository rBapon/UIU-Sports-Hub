<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $prayerName = $_POST["prayerName"];
    $newTime = $_POST["newTime"];

    // Convert time to 12-hour format with AM/PM before inserting into the database
    $newTimeFormatted = date("h:i A", strtotime($newTime));

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "root1234";
    $dbname = "uiu sports hub";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update prayer time in the database
    $sql = "UPDATE prayer_time SET $prayerName = '$newTimeFormatted'";

    if ($conn->query($sql) === TRUE) {
        echo "Prayer time updated successfully";
    } else {
        echo "Error updating prayer time: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prayer Time</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>

<body>
    <!-- Edit Prayer Time Form -->
    <div id="editPrayerTimeModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Prayer Time</h2>
            <form method="POST" id="editPrayerTimeForm">
                <label for="prayerName">Prayer Name:</label>
                <select id="prayerName" name="prayerName">
                    <option value="FAJR">FAJR</option>
                    <option value="DHUHR">DHUHR</option>
                    <option value="ASR">ASR</option>
                    <option value="MAGHRIB">MAGHRIB</option>
                    <option value="ISHA">ISHA</option>
                </select>

                <label for="newTime">New Time:</label>
                <input type="time" id="newTime" name="newTime" required>

                <button type="submit">Update Time</button>
            </form>
        </div>
    </div>

</body>

</html>
