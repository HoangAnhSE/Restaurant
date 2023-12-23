<?php
$conn = new mysqli('localhost', 'root', '', 'restaurant');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM booking";
$result = $conn->query($sql);

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
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Bookings</title>
</head>
<body>
    <h2>User Bookings</h2>
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

                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
                
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
                    echo "<td>";
                    if ($row['status'] == 'pending') {
                        echo "<form method='post'>
                            <button type='submit' name='your Booking Accept by admin' value='".$row['id']."'>Accep</button>
                            <button type='submit' name='your Booking Decline by admin' value='".$row['id']."'>Decline</button>
                            </form>";
                    } else {
                        echo "";
                    }
                    echo "</td>";
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
