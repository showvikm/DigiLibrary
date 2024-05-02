<?php

session_start();
if (isset($_SESSION['user-username'])) {

  require_once 'Include/db.php';

  $current_user = $_SESSION['user-username'];

  $price = 9.99;

?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="Include/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async>

    </script>

    <script>
      function validateForm() {
        var billing_address = document.forms["checkout"]["Address"].value;
        var credit_card = document.forms["checkout"]["credit-card"].value;
        var cvv = document.forms["checkout"]["cvv"].value;
        if ((billing_address == "" || billing_address == null) && (credit_card == "" || credit_card == null) && (cvv == "" || cvv == null)) {
          alert("Address, credit card and cvv must be filled out. Press Edit to fill in those informaion.");
          return false;
        }
      }
    </script>

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

      <div class="intro-content text-white">
        <div class="container">
          <?php

          global $ConnectingDB;
          $sql = "SELECT * From user_accounts WHERE username='$current_user'";
          $stmt = $ConnectingDB->query($sql);
          while ($data_rows = $stmt->fetch()) {
            $id             = $data_rows['id'];
            $name = $data_rows['name'];
            $billing_address = $data_rows['billing_address'];
            $credit_card    = $data_rows['credit_card_number'];
            $cvv            = $data_rows['cvv'];
          }

          ?>

          <div class="checkout" align="center">
            <h2>Checkout<h2>
                <h4> Monthly Subscribtion fee CA $<?php echo $price ?> </h4>
                <h4> Subtotal: CA $<?php echo $price ?></h4>

          </div>
          <div class="box">
            <form name="checkout" class="" action="confirmation.php?" onsubmit="return validateForm()">
              <div class="input-group">
                <span>Name</span>
                <input type="text" class="inp" id="Name" name="Name" placeholder=" John" value="<?php echo $name; ?>" disabled />
              </div>

              <div class="input-group">
                <span>Billing Address</span>
                <input type="text" placeholder="Ex. 123 Markham Drive" name="Address" class="inp" value="<?php echo $billing_address ?>" disabled required />
              </div>
              <div class="input-group">
                <span>Credit Card Number</span>
                <input type="number" placeholder="" name="credit-card" class="inp" value="<?php echo $credit_card ?>" disabled required />
              </div>
              <div class="input-group">
                <span>Credit Card CVV</span>
                <input type="password" placeholder="" name="cvv" class="inp" 
                value="<?php echo $cvv ?>" disabled required />
              </div>

              <div class="input-group">
                <input type="submit" value="Confirm" class="inp submit-inp" />
              </div>

            </form>
          </div>

          <div class="box">
            <div class="input-group">
              <input type="submit" value="Edit" class="inp submit-inp" onclick="window.location.href='edit-checkout.php?id=<?php echo $id; ?>'" />
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
  header('Location: index.php');

  

}

// EOF

?>