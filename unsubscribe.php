<?php

session_start();
if (isset($_SESSION["user-username"])) {

  // needs to connect to database
  require_once "Include/db.php";
  $currentuser = $_SESSION["user-username"];




  if (isset($_POST["Submit"])) {
    global $ConnectingDB;
    $sql = "UPDATE user_accounts SET subscribed='0' WHERE username='$currentuser'";
    $Execute = $ConnectingDB->query($sql);
    if ($Execute) {
      echo '<script>window.open("user-profile.php","_self")</script>';
    } else {
      echo '<script>alert("Changes were not updated, please try again")</script>';
    }
  }

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="Include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
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
            <li class="nav-item"><a class="nav-link" href="user-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="subscribe.php"><i class="fa fa-fw fa-check"></i> Subscribe</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-fw fa-lock"></i> Log out</a></li>
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
          <?php
          global $ConnectingDB;
          $sql = "SELECT * From user_accounts WHERE username='$currentuser'";
          $stmt = $ConnectingDB->query($sql);
          while ($DataRows = $stmt->fetch()) {
            $subcription    = $DataRows["subscribed"];
          }
          ?>

          <div class="box">
            <div class="sub-list" align="center">
              <h2>We are sad to see you go</h2>
              <p>
                Please click below to unsubscribe
              </p>
            </div>
            <div class="">
              <form style="text-align: center;" name="Submit" action="unsubscribe.php?id=<?php echo $currentuser; ?>" method="POST">
                <button type="submit" name="Submit" class="btn btn-warning btn-lg mr-lg-2 ">Unsubscribe</button>
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

<?php } else {
  header("Location: home.php");
} ?>