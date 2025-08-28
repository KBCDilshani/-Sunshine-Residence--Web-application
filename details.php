<?php
include("config.php");

// Function to display success or error message
function showMessage($message, $type = 'success') {
    return '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
}

// Check if update or delete action is triggered
if(isset($_GET['action'])) {
    $action = $_GET['action'];

    // Delete action
    if($action == 'delete') {
        // Ensure you have the ID of the entry to delete
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM `contact-data` WHERE `id`=$id";
            $result = $mysqli->query($sql);
            if($result) {
                echo showMessage("Data deleted successfully");
            } else {
                echo showMessage("Couldn't delete data: ".$mysqli->error, 'danger');
            }
        } else {
            echo showMessage("Entry ID not provided for deletion", 'danger');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3>Contact Details</h3>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- PHP code to fetch and display contact details from the database -->
        <?php
        $sql = "SELECT * FROM `contact-data`";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["firstname"]."</td>";
                echo "<td>".$row["lastname"]."</td>";
                echo "<td>".$row["phone"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["message"]."</td>";
                echo "<td>
                                <a href='ContactUS.php?action=update&id=".$row['id']."' class='btn btn-primary'>Update</a>
                                <a href='details.php?action=delete&id=".$row['id']."' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this entry?\");'>Delete</a>
                              </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
