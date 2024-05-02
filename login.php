<?php

/**
 * Login page of the file 
*/

session_start(); 
require_once("Include/db.php");

// if user or employee is logged in.
if (!isset($_SESSION["user-username"]) || !isset($_SESSION["employee-username"])) {

    // checks if the user submits the button
    if (isset($_POST["user-submit"])) {
        $inputUsername = $_POST["user-username"];
        $inputPassword = $_POST["user-password"];

        // checks if the input field is not empty
        if (!empty($inputUsername) && !empty($inputPassword)) {

            $accountFound = 0;

            // $ConnectingDB from Include/DB.php
            global $ConnectingDB;
            $sql = "SELECT * FROM user_accounts WHERE username=:usernamE";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':usernamE', $inputUsername);
            $stmt->execute();

            // Loops through the database
            while ($DataRows = $stmt->fetch()) {
                $DBusername             = $DataRows["username"];
                $DBpassword             = $DataRows["password"];

                // Checks if the username and password verifies with the database
                if (($inputUsername == $DBusername) && password_verify($inputPassword, $DBpassword)) {
                    $_SESSION['user-username'] = $DBusername;
                    echo '<script>window.open("view-catalog.php","_self")</script>';
                    $accountFound = 1;
                }
            }

            // checks if the account found and print on html
            if ($accountFound == 0) {
                // echo "<span class='FieldInfoHeading'>Sorry, Please Try Again</span>";
                echo '<script>alert("Sorry, Please Try Again")</script>';
            }
        // print invalid statement.
        } else {
            // echo "<span class='FieldInfoHeading'>Please add Valid Username or Password</span>";
            echo '<script>alert("Please add Valid Username or Password")</script>';
        }
    }

    // checks if the employee submits the button
    if (isset($_POST["employee-submit"])) {
        $inputUsername = $_POST["employee-username"];
        $inputPassword = $_POST["employee-password"];

        // checks if the input field is not empty
        if (!empty($inputUsername) && !empty($inputPassword)) {

            $accountFound = 0;

            // $ConnectingDB from Include/DB.php
            global $ConnectingDB;
            $sql = "SELECT * FROM employee_accounts WHERE username=:usernamE";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':usernamE', $inputUsername);
            $stmt->execute();

            // Loops through the database
            while ($DataRows = $stmt->fetch()) {
                $DBusername             = $DataRows["username"];
                $DBpassword             = $DataRows["password"];

                // Checks if the username and password verifies with the database
                if (($inputUsername == $DBusername) && password_verify($inputPassword, $DBpassword)) {
                    $_SESSION['employee-username'] = $DBusername;
                    echo '<script>window.open("view-catalog.php","_self")</script>';
                    $accountFound = 1;
                }
            }

            // checks if the account found and print on html
            if ($accountFound == 0) {
                // echo "<span class='FieldInfoHeading'>Sorry, Please Try Again</span>";
                echo '<script>alert("Sorry, Please Try Again")</script>';
            }
        // print invalid statement.
        } else {
            // echo "<span class='FieldInfoHeading'>Please add Valid Username or Password</span>";
            echo '<script>alert("Please add Valid Username or Password")</script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16"/>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="Include/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async>
    </script>
    <style>        
        .toggle-btn:before{
            content: 'Switch to Employee Login';
            
        }

        .toggle-btn:checked:before{
            content: 'Switch to Customer Login';
            left: 25%;
        }
    </style>
</head>

<body>
    <nav id="main-nav" class="navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Digi Lib</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">            
            <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>            
            <li class="nav-item"><a class="nav-link active" href="login.php"><i class="fa fa-fw fa-user"></i> Login</a></li>
            <li class="nav-item"><a class="nav-link" href="signup.php"><i class="fa fa-fw fa-user"></i> Signup</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="intro min-height position-relative text-white">
      <div class="home-bg">
        <img class="img-fluid img-cover" src="Images/home-bg.jpg" alt="Library">
      </div>      
      
        <div class="intro-content text-white">
            <div class="container">
                <div class="box">                
                    <input type="checkbox" class="toggle-btn btn btn-warning btn-lg mr-lg-2" name="" />
                    <div class="user-form">
                        <h2>Customer Login</h2>
                        <form class="" action="login.php" method="POST">
                        <div class="input-group">
                            <span>Username</span>
                            <input type="text" placeholder="Ex. abc123" name="user-username" class="inp"/>
                        </div>
                        <div class="input-group">
                            <span>Password</span>
                            <input type="password" placeholder="******" name="user-password" class="inp"/>
                        </div>
                        <div class="input-group" style="margin-top: 20px;">
                            <input type="submit" value="Login as User" name="user-submit" class="inp submit-inp btn btn-warning btn-lg mr-lg-2" />
                        </div>
                        <div class="input-group" style="margin-top: 20px;">               
                            <input type="button" value="Go to Sign Up" class="inp submit-inp btn btn-warning btn-lg mr-lg-2" onclick="window.location.href='signup.php'"/>
                        </div>
                        </form>                    
                    </div>
                    <div class="employee-form">
                        <h2>Employee Login</h2>
                            <form class="" action="login.php" method="POST">
                                <div class="input-group">
                                    <span>Username</span>
                                    <input type="text" placeholder="Ex. abc123" name="employee-username" class="inp"/>
                                </div>
                                <div class="input-group">
                                    <span>Password</span>
                                    <input type="password" placeholder="******" name="employee-password" class="inp"/>
                                </div>
                                <div class="input-group" style="margin-top: 20px;">
                                    <input type="submit" value="Login as Employee" name="employee-submit" class="inp submit-inp btn btn-warning btn-lg mr-lg-2"/>
                                </div>
                                <div class="input-group" style="margin-top: 20px;">                    
                                    <input type="button" value="Go to Sign Up" class="inp submit-inp btn btn-warning btn-lg mr-lg-2" onclick="window.location.href='signup.php'"/>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright py-4 text-center text-white">
      <div class="container"><span>Copyright &copy; Digi Lib 2022</span></div>
    </div>
</body>

</html>

<?php 
 
// if not logged in
} else {
    header("Location: index.php"); // !---------- change
} 

// EOF

?>