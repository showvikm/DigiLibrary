<?php

session_start();

if (isset($_SESSION["user-username"]) || isset($_SESSION["employee-username"])) {

?>
  <?php

  $is_user = "";
  $is_employee = "";
  if (isset($_SESSION["user-username"])) {
    $currentuser = $_SESSION["user-username"];
    $is_user = $_SESSION["user-username"];
  } else {
    $currentuser = $_SESSION["employee-username"];
    $is_employee = $_SESSION["employee-username"];
  }


  //$availability = "6y";

  require_once "Include/db.php";

  // shows the existing data in the table
  $SearchQuery = $_GET["id"];

  global $ConnectingDB;
  $sql = "SELECT * FROM catalog WHERE id='$SearchQuery'";
  // gets the info from the table using id so we can edit/update
  $stmt = $ConnectingDB->query($sql);
  while ($DataRows = $stmt->fetch()) {
    $Name = $DataRows["name"];
    $author_dev_artist = $DataRows["author_dev_artist"];
    $type = $DataRows["type"];
    $isbn = $DataRows["isbn"];
    $available = $DataRows["available"];
    $image_link = $DataRows["image_link"];
    $item_link = $DataRows["item_link"];
  }

  $subscribed = 0;
  $user = "SELECT * FROM user_accounts WHERE username='$is_user'";
  $userstmt = $ConnectingDB->query($user);
  while ($DataRows = $userstmt->fetch()) {
    $username = $DataRows["username"];
    $subscribed = $DataRows["subscribed"];
  }

  $rented = 0;
  $sql = "SELECT * From user_items";
  $stmt = $ConnectingDB->query($sql);
  while ($DataRows = $stmt->fetch()) {
    $user_name                 = $DataRows["username"];
    $catalogid                 = $DataRows["catalog_id"];

    if (($user_name == $is_user) && ($catalogid == $SearchQuery)) {
      $rented = 1;
    }
  }


  if (isset($_POST["rent"])) {

    $username;
    $bookname;
    // connected to database
    global $ConnectingDB;


    $user = "SELECT * FROM user_accounts WHERE username='$is_user'";
    $userstmt = $ConnectingDB->query($user);
    while ($DataRows = $userstmt->fetch()) {
      $username = $DataRows["username"];
    }

    $item = "SELECT * FROM catalog WHERE id='$SearchQuery'";
    $itemstmt = $ConnectingDB->query($item);
    while ($DataRows = $itemstmt->fetch()) {
      $bookname = $DataRows["name"];
    }

    $rent = "INSERT INTO user_items(username, item, catalog_id) VALUES(:usernamE, :booknamE, :catiD)";
    $rentstmt = $ConnectingDB->prepare($rent);
    $rentstmt->bindValue(':usernamE', $username);
    $rentstmt->bindValue(':booknamE', $bookname);
    $rentstmt->bindValue(':catiD', $SearchQuery);


    $Execute = $rentstmt->execute();
    if ($Execute) {
      echo "<meta http-equiv='refresh' content='0'>";
      echo '<script>alert("Item rented sucesseful")</script>';
    } else {
      echo '<script>alert("Unable to rent item")</script>';
    }

  }


  ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item</title>
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
            <?php

            // if employee logged in
            if (isset($_SESSION["employee-username"])) {

            ?>
              <li class="nav-item"><a class="nav-link" href="insert-into-database.php"><i class="fa fa-fw fa-plus"></i> Insert</a></li>
              <li class="nav-item"><a class="nav-link" href="view-catalog.php"><i class="fa fa-fw fa-search"></i> Catalog</a></li>
              <li class="nav-item"><a class="nav-link" href="employee-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="view-employee.php"><i class="fa fa-fw fa-group"></i> Employees</a></li>

            <?php

              // if customer logged in
            } else {

            ?>
              <li class="nav-item"><a class="nav-link" href="view-catalog.php"><i class="fa fa-fw fa-search"></i> Catalog</a></li>
              <li class="nav-item"><a class="nav-link" href="user-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="subscribe.php"><i class="fa fa-fw fa-check"></i> Subscribe</a></li>
            <?php

            }

            ?>
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
          <div class="row">
            <div class="col-md-4">
              <h2 style="text-align: center;"><?php echo $Name ?></h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <img class="img-fluid" src="./Images/<?php echo $image_link ?>"></img>
            </div>

            <div class="col-md-6">
              <p><b>Author | Dev | Artist:</b> <?php echo $author_dev_artist ?></p>
              <p><b>Type:</b> <?php echo $type ?></p>
              <p><b>Available:</b>
                <?php if ($available == 1) {
                  echo "Yes";
                } else {
                  echo "No";
                }; ?>
              </p>
              <p><b>ISBN:</b> <?php echo $isbn ?></p>
              <?php if ($currentuser == $is_employee) { ?>
                <a class="btn btn-warning btn-md mr-lg-2" href="./Item_documents/<?php echo $item_link ?>">View Item</a>

                <?php
              } else {
                if ($subscribed == 1 || $type == "book") {
                  if ($available == 1) {
                    if ($rented == 0) {
                ?>
                      <form method="POST">
                        <input type="submit" value="Rent" name="rent"> </input>
                      </form>
                    <?php
                    } else {
                    ?>
                      <p>
                        Please click <a class="btn btn-warning btn-md mr-lg-2" href="./Item_documents/<?php echo $item_link ?>">here</a> to view your item
                      </p>
              <?php
                    }
                  } else {
                    echo '<p>The content is not Available</p>';
                  }
                } else {
                  echo '<p>Please Subscribe To View the Contents</p>';
                }
              }
              ?>
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
} else {
  header("Location: index.php");
} ?>

<!-- EOF -->