<?php

session_start();

if (isset($_SESSION["user-username"])) {

  // needs to connect to database
  require_once "Include/db.php";

  $currentUser = $_GET["id"];




  if (isset($_POST["Submit"])) {
    if (
      !empty($_POST["Name"]) && !empty($_POST["Address"]) &&
      !empty($_POST["email"]) && !empty($_POST["credit-card"]) &&
      !empty($_POST["cvv"])
    ) {
      $name = $_POST["Name"];
      $address = $_POST["Address"];
      $email = $_POST["email"];
      $credit_card = $_POST["credit-card"];
      $cvv = $_POST["cvv"];

      if (!empty($_POST["password"])) {
        $password = $_POST["password"];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        global $ConnectingDB;
        if (strlen($credit_card) == 16 && strlen($cvv) == 3) {
          $sql = "UPDATE user_accounts SET name='$name', billing_address='$address', email='$email', credit_card_number='$credit_card', cvv='$cvv',
          password='$hash' WHERE id='$currentUser'";
          $Execute = $ConnectingDB->query($sql);
        }
      } else {
        global $ConnectingDB;
        if (strlen($credit_card) == 16 && strlen($cvv) == 3) {
          $sql = "UPDATE user_accounts SET name='$name', billing_address='$address', email='$email', credit_card_number='$credit_card', cvv='$cvv' WHERE id='$currentUser'";
          $Execute = $ConnectingDB->query($sql);
        }
      }

      if (strlen($credit_card) == 16 && strlen($cvv) == 3) {
        if ($Execute) {
          echo '<script>window.open("user-profile.php?id="Record Update Successfully","_self")</script>';
        }
      } else {
        echo '<script>alert("Changes were not updated, please try again")</script>';
      }
    } else if (!empty($_POST["Address"] && !empty($_POST["credit-card"]) && !empty($_POST["cvv"]))) {
      $address = $_POST["Address"];
      $credit_card = $_POST["credit-card"];
      $cvv = $_POST["cvv"];

      global $ConnectingDB;
      $sql = "INSERT INTO user_accounts(address, credit_card_number, cvv) VALUES(:addresS, :credit_card_numbeR, :cvV)";
      $stmt = $ConnectingDB->prepare($sql);
      $stmt->bindValue(':addresS', $address);
      $stmt->bindValue(':credit_card_numbeR', $credit_Card);
      $stmt->bindValue(':cvV', $cvv);

      $Execute = $stmt->execute();
      if ($Execute) {
        echo '<script>window.open("user-profile.php?id="Record Update Successfully","_self")</script>';
      }
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="Include/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async></script>

    <script>
      // Feel free to change the settings on your need
      var botmanWidget = {
        frameEndpoint: 'chat.html',
        chatServer: 'botman.php',
        title: 'ChatBot',
        introMessage: 'Hi and welcome to Digi_Lib. How can I help you?',
        placeholderText: 'Ask Me Something',
        mainColor: '#F28240',
        bubbleBackground: '#F28240',
        bubbleAvatarUrl: 'https://www.applozic.com/assets/resources/images/Chat-Bot-Icon@512px.svg'
      };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

    <style>
      .user-profile {
        margin: 1rem;
      }

      .btn {
        margin-top: 1rem;
      }

      .form-label {
        padding-top: 10px;
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
            <li class="nav-item"><a class="nav-link" href="view-catalog.php"><i class="fa fa-fw fa-search"></i> Catalog</a></li>
            <li class="nav-item"><a class="nav-link active" href="user-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="subscribe.php"><i class="fa fa-fw fa-check"></i> Subscription</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-fw fa-lock"></i> Log out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="intro min-height position-relative text-white">
      <div class="home-bg">
        <img class="img-fluid img-cover" src="Images/home-bg.jpg" alt="Library">
      </div>

      <div class="intro-content">
        <div class="container">
          <?php


          global $ConnectingDB;
          $sql = "SELECT * From user_accounts WHERE id='$currentUser'";
          $stmt = $ConnectingDB->query($sql);
          while ($DataRows = $stmt->fetch()) {
            $Id             = $DataRows["id"];
            $Name           = $DataRows["name"];
            $billing_Address = $DataRows["billing_address"];
            $email          = $DataRows["email"];
            $credit_Card    = $DataRows["credit_card_number"];
            $cvv            = $DataRows["cvv"];
            $username       = $DataRows["username"];
            $password       = $DataRows["password"];
            $rented         = $DataRows["rented_catalog"];
            $subcription    = $DataRows["subscribed"];
          }
          ?>
          <div>
            <form class="" action="edit-user-profile.php?id=<?php echo $currentUser; ?>" method="POST">
              <div class="user-profile row">
                <div class="col-md-6">
                  <label for="Name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="Name" name="Name" placeholder=" John" value="<?php echo $Name; ?>" required />
                </div>
                <div class="col-md-6">
                  <label for="Address" class="form-label">Billing Address</label>
                  <input type="text" class="form-control" id="Address" name="Address" placeholder="1234 Main st" value="<?php echo $billing_Address; ?>" required />
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="john.smith@gmail.com" name="email" value="<?php echo $email; ?>" required />
                </div>
                <div class="col-md-3">
                  <label for="credit-card" class="form-label">Credit Card Number</label>
                  <input type="text" class="form-control" id="credit-card" name="credit-card" placeholder="Must be 16 digit" value="<?php echo $credit_Card; ?>" required />
                </div>
                <div class="col-md-3">
                  <label for="cvv" class="form-label">CVV</label>
                  <input type="password" class="form-control" id="cvv" name="cvv" placeholder="Must be 3" value="<?php echo $cvv; ?>" required />
                </div>

                <div class="col-md-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="jsmith" value="<?php echo $username; ?>" disabled />
                </div>
                <div class="col-md-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="col-md-3">
                  <label for="number" class="form-label">Items Rented: </label>
                  <p><?php if ($rented == NULL) {
                        echo "0";
                      } else {
                        echo "$rented";
                      }
                      ?>
                  </p>
                </div>
                <div class="col-md-3">
                  <label for="subscription" class="form-label">Subscription: </label>
                  <p><?php if ($subcription == 0) {
                        echo "No subscription on file";
                      } else {
                        echo "Subscrived";
                      }
                      ?>
                  </p>
                </div>
                <div class="container">
                  <div class="row justify-content-middle">
                    <div class="col-4">
                      <button type="submit" name="Submit" class="btn btn-warning btn-lg mr-lg-2">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                          echo "Information Updated";
                        } else {
                          echo "Save";
                        } ?>
                      </button>
                    </div>

                  </div>
                </div>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>
    <div class="copyright py-4 text-center text-white">
      <div class="container"><span>Copyright &copy; Digi Lib 2022</span></div>
    </div>
  </body>

  </html>

<?php } else {
  header("Location: home.php");
} ?>

<!-- EOF -->