<?php
// needs to connet to database
require_once "Include/db.php";     


if (isset($_POST["employee-submit"])) {
    if (!empty($_POST["employee-name"]) && !empty($_POST["employee-username"]) && !empty($_POST["employee-password"])) {
        $name = $_POST["employee-name"];
        $username = $_POST["employee-username"];
        $password = $_POST["employee-password"];


        global $ConnectingDB;

        // checks if the username exists in the database if it exists then <span> add unique username</span>
        $mySql = "SELECT * FROM employee_accounts WHERE username=:user";
        $search = $ConnectingDB->prepare($mySql);
        $search->bindValue(':user', $username);
        $search->execute();
        $DBusername = "";
        while ($DataRows = $search->fetch()) {
           $DBusername             = $DataRows["username"];
        }
        // ------------------------------------------------------------------------------------------

        if (strtolower($DBusername) != strtolower($username)) {
            $sql = "INSERT INTO employee_accounts(name, username, password) VALUES(:namE, :usernamE, :passworD)";
                    $stmt = $ConnectingDB->prepare($sql);
                    $stmt->bindValue(':namE', $name);
                    $stmt->bindValue(':usernamE', $username);
                    $stmt->bindValue(':passworD', password_hash($password, PASSWORD_DEFAULT));
            
            $Execute = $stmt->execute();
            if ($Execute) {
                // echo '<span class="success">Account has been Created Successfully</span>';
                echo '<script>alert("Account has been Created Successfully")</script>';
                echo '<script>window.open("login.php","_self")</script>';
            }
        }
        else {
            // echo "<span class='FieldInfoHeading'>Username Already Exists</span>";
            echo '<script>alert("Username Already Exists")</script>';
        }
    } else {
        // echo "<span class='FieldInfoHeading'>Please add Username and Password. OR have a Unique Username</span>";
        echo '<script>alert("Please add Username and Password. OR have a Unique Username")</script>';
    }
}


if (isset($_POST["user-submit"])) {
    if (!empty($_POST["user-name"]) && !empty($_POST["user-email"]) && !empty($_POST["user-username"]) && !empty($_POST["user-password"])) {
        $name = $_POST["user-name"];
        // $address = $_POST["user-address"];
        $email = $_POST["user-email"];
        // $creditCard = $_POST["user-creditCard"];
        // $cvv = $_POST["user-cvv"];
        $username = $_POST["user-username"];
        $password = $_POST["user-password"];


        global $ConnectingDB;

        // checks if the username exists in the database if it exists then <span> add unique username</span>
        $mySql = "SELECT * FROM user_accounts WHERE username=:user";
        $search = $ConnectingDB->prepare($mySql);
        $search->bindValue(':user', $username);
        $search->execute();
        $DBusername = "";
        while ($DataRows = $search->fetch()) {
           $DBusername             = $DataRows["username"];
        }
        // ------------------------------------------------------------------------------------------

        if (strtolower($DBusername) != strtolower($username)) {
            $sql = "INSERT INTO user_accounts(name, email, username, password) VALUES(:namE, :emaiL, :usernamE, :passworD)";
                    $stmt = $ConnectingDB->prepare($sql);
                    $stmt->bindValue(':namE', $name);
                    // $stmt->bindValue(':addresS', $address);
                    $stmt->bindValue(':emaiL', $email);
                    // $stmt->bindValue(':creditcarD', $creditCard);
                    // $stmt->bindValue(':cvV', $cvv);
                    $stmt->bindValue(':usernamE', $username);
                    $stmt->bindValue(':passworD', password_hash($password, PASSWORD_DEFAULT));
            
            $Execute = $stmt->execute();
            if ($Execute) {
                // echo '<span class="success">Account has been Created Successfully</span>';
                echo '<script>alert("Account has been Created Successfully")</script>';
                echo '<script>window.open("login.php","_self")</script>';
            }
        }
        else {
            // echo "<span class='FieldInfoHeading'>Username Already Exists</span>";
            echo '<script>alert("Username Already Exists")</script>';
        }
    } else {
        // echo "<span class='FieldInfoHeading'>Please add Username and Password. OR have a Unique Username</span>";
        echo '<script>alert("Please add Username and Password. OR have a Unique Username")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16"/>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="Include/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async>
    </script>
    <style>
        .toggle-btn:before{
            content: 'Switch to Employee Signup';            
        }

        .toggle-btn:checked:before{
            content: 'Switch to Customer Signup';
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
            <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-fw fa-user"></i> Login</a></li>
            <li class="nav-item"><a class="nav-link active" href="signup.php"><i class="fa fa-fw fa-user"></i> Signup</a></li>
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
                        <h2>Customer Signup</h2>
                        <form class="" action="signup.php" method="POST">
                            <div class="input-group">
                            <span>Name</span>
                            <input type="text" placeholder="Ex. John Smith" name="user-name" class="inp"/>
                        </div>
                        <div class="input-group">
                            <span>Email</span>
                            <input type="email" placeholder="Ex. jsmith123@xyz.com" name="user-email" class="inp"/>
                        </div>
                        
                        <div class="input-group">
                            <span>Username</span>
                            <input type="text" placeholder="Ex. jsmith123" name="user-username" class="inp"/>
                        </div>
                        <div class="input-group">
                            <span>Password</span>
                            <input type="password" placeholder="******" name="user-password" class="inp"/>
                        </div>
                        <div class="input-group" style="margin-top: 20px;">
                            <input type="submit" value="Signup as User" name="user-submit" class="inp submit-inp btn btn-warning btn-lg mr-lg-2"/>
                        </div>
                        <div class="input-group" style="margin: 20px 0;">                    
                            <input type="button" value="Go to Login" class="inp submit-inp btn btn-warning btn-lg mr-lg-2" onclick="window.location.href='login.php'"/>
                        </div>
                        </form>                    
                    </div>

                    <div class="employee-form">
                        <h2>Employee Signup</h2>
                        <form class="" action="signup.php" method="POST">
                            <div class="input-group">
                                <span>Name</span>
                                <input type="text" placeholder="Ex. Harry Potter" name="employee-name" class="inp"/>
                            </div>
                            <div class="input-group">
                                <span>Username</span>
                                <input type="text" placeholder="Ex. abc123" name="employee-username" class="inp"/>
                            </div>
                            <div class="input-group">
                                <span>Password</span>
                                <input type="password" placeholder="******" name="employee-password" class="inp"/>
                            </div>
                            <div class="input-group" style="margin-top: 20px;"> 
                                <input type="submit" value="Signup as Employee" name="employee-submit" class="inp submit-inp btn btn-warning btn-lg mr-lg-2"/>
                            </div>
                            <div class="input-group" style="margin: 20px 0;">                    
                                <input type="button" value="Go to Login" class="inp submit-inp btn btn-warning btn-lg mr-lg-2" onclick="window.location.href='login.php'"/>
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

//EOF 

?>
