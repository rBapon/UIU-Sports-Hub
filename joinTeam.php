<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "root1234";
$dbname = "uiu sports hub";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $teamName = $_POST["teamName"];

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Update the user's team choice
        $sql = "UPDATE user_teams SET team_name = :teamName WHERE user_id = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":teamName", $teamName, PDO::PARAM_STR);
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Team joined successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $pdo = null;
}

// Fetch list of created tables for display
$teamList = [];
try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch list of tables
    $stmt = $pdo->query("SHOW TABLES");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $teamList[] = $row;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Join Team</title>
</head>

<body>

    <h1>Join a Team</h1>

    <h2>Available Teams</h2>
    <ul>
        <?php foreach ($teamList as $team) : ?>
            <li><?php echo $team["Tables_in_uiu_sports_hub"]; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Join a Team</h2>
    <form method="post">
        <label for="userId">Your ID:</label>
        <input type="text" id="userId" name="userId" required><br>

        <label for="teamName">Team Name:</label>
        <input type="text" id="teamName" name="teamName" required><br>

        <button type="submit">Join Team</button>
    </form>

</body>

</html>
