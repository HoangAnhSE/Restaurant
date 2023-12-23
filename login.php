<?php
session_start(); // Start the session

$conn = new mysqli('localhost', 'root', '', 'restaurant');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assuming you have a 'users' table with columns 'username', 'password', and 'usertype'
    $sql = "SELECT * FROM `login` WHERE `username`='$username' AND `password`='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found in the database
        $row = $result->fetch_assoc();

        if ($row["usertype"] == "user") {
            $_SESSION["username"] = $username;
            header("location: userhome.php"); // Redirect to user's home page
            exit();
        } elseif ($row["usertype"] == "admin") {
            $_SESSION["username"] = $username;
            header("location: adminhome.php"); // Redirect to admin's home page
            exit();
        }
    } else {
        echo "Username or password incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <style>
    body {
      <?php $background_url = 'https://assets.architecturaldigest.in/photos/6385cf3311f0276636badfb6/16:9/w_2560%2Cc_limit/DSC_8367-Edit-W.png'; ?>
      background-image: url('<?php echo $background_url; ?>');
      background-size: cover;
      background-repeat: no-repeat;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    #form {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      text-align: center;
    }

    .nav-link {
      color: #333;
      text-decoration: none;
    }

    h1 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div id="form">
  <a class="nav-link" href="index.php">Home </a>
  <h1>-------Login------ </h1>
  <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
    <label>Username: </label>
    <input type="text" id="user" name="username"><br><br>
    <label>Password: </label>
    <input type="password" id="pass" name="password"><br><br>
    <input type="submit" id="btn" value="Login" name="submit"/>
  </form>
</div>

<script>
  function isvalid() {
    var user = document.form.username.value;
    var pass = document.form.password.value;
    if (user.length === 0 && pass.length === 0) {
      alert("Username and password field is empty!!!");
      return false;
    } else if (user.length === 0) {
      alert("Username field is empty!!!");
      return false;
    } else if (pass.length === 0) {
      alert("Password field is empty!!!");
      return false;
    }
  }
</script>

</body>
</html>


