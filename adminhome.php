<?php
$conn = new mysqli('localhost', 'root', '', 'restaurant');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {
        $booking_id = $_POST['accept'];
        $sql = "UPDATE booking SET status = 'accepted' WHERE id = $booking_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking accepted');</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['decline'])) {
        $booking_id = $_POST['decline'];
        $sql = "UPDATE booking SET status = 'declined' WHERE id = $booking_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking declined');</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['delete'])) {
        $booking_id = $_POST['delete'];
        $sql = "DELETE FROM booking WHERE id = $booking_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking deleted');</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

$sql = "SELECT * FROM booking";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Bookings</title>
    <style>
		  body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            background-color: #fff;
            margin: 20px auto;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        button {
            padding: 8px 16px;
            margin-right: 5px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            opacity: 0.8;
        }
        .accept {
            background-color: #4CAF50;
            color: white;
        }
        .decline {
            background-color: #f44336;
            color: white;
        }
        .delete {
            background-color: #ff9800;
            color: white;
        }
        .action-buttons {
            display: flex;
            justify-content: flex-start;
        }
        .action-buttons button {
            margin-right: 10px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            background-color: #fff;
            margin: 20px auto;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            text-transform: capitalize;
        }
        th.name {
            background-color: #2196F3;
            color: white;
        }
        th.phone {
            background-color: #FFC107;
            color: #333;
        }
        th.email {
            background-color: #9C27B0;
            color: white;
        }
        th.amount {
            background-color: #4CAF50;
            color: white;
        }
        th.date {
            background-color: #FF5722;
            color: white;
        }
        th.status {
            background-color: #607D8B;
            color: white;
        }
        th.action {
            background-color: #E91E63;
            color: white;
        }
        button {
            padding: 8px 16px;
            margin-right: 5px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h2>Admin Bookings</h2>
    <table border="1">
        <thead>
            <tr>
			<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Outlined Link</title>
    <style>
        /* Styling for the container */
        .container {
            text-align: right; /* Align contents to the right */
            padding: 20px; /* Add some padding for spacing */
        }

        /* Styling for the outlined link */
        .nav-link {
            text-decoration: none; /* Remove default underline */
            padding: 8px 12px;
            border: 2px solid #007bff; /* Blue color outline */
            color: #007bff; /* Blue color text */
            border-radius: 5px; /* Rounded corners */
            transition: all 0.3s ease; /* Smooth transition */
        }

        .nav-link:hover {
            background-color: #007bff; /* Background color on hover */
            color: #fff; /* Text color on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <a class="nav-link" href="login.php">Logout</a>
    </div>
</body>

</html>

                <th class="name">Name</th>
                <th class="phone">Phone</th>
                <th class="email">Email</th>
                <th class="amount">Amount</th>
                <th class="date">Date</th>
                <th class="status">Status</th>
                <th class="action">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "<td>".$row['mail']."</td>";
                    echo "<td>".$row['amount']."</td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['status']."</td>";
                    echo "<td class='action-buttons'>
                            <form method='post'>
                                <button class='accept' type='submit' name='accept' value='".$row['id']."'>Accept</button>
                                <button class='decline' type='submit' name='decline' value='".$row['id']."'>Decline</button>
                                <button class='delete' type='submit' name='delete' value='".$row['id']."'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No bookings yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
