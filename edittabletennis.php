<?php
$servername = "localhost";
$username = "root";
$password = "root1234";
$dbname = "uiu sports hub";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save_changes'])) {
    $table_tennis = $_POST['table_tennis'];

    // Update the inventory values in the database
    $updateQuery = "UPDATE inventory SET table_tennis='$table_tennis'"; 
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        // Redirect back to the inventory page or show a success message
        //header("Location: adminInventory.php?update_success=true");
        echo "update successfully";
        exit;
    } else {
        // Handle error
        echo "Error updating inventory: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table_tennis</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .inventory-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #FF6F61;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #FF8C82;
        }
    </style>
</head>

<body>

<!-- Inventory Form -->
<div class="inventory-form">
    <h2>Edit Inventory</h2>
    <form method="post" action="edittabletennis.php">
        <div class="form-group">
            <label for="table_tennis">Table Tennis:</label>
            <input type="number" name="table_tennis" id="table_tennis" value="<?php echo $row['table_tennis']; ?>">
        </div>
        
        <div class="form-group">
            <button type="submit" name="save_changes">Save Changes</button>
        </div>
    </form>
</div>

</body>
</html>