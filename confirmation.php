<?php

session_start();
if (isset($_SESSION['user-username'])) {

  require_once 'Include/db.php';

  $current_user = $_SESSION['user-username'];
  $subscribed = 1;

  $sql = "UPDATE user_accounts SET subscribed='$subscribed' WHERE username='$current_user'";
      $execute = $ConnectingDB->query($sql);
      if ($execute) {
        echo '<script>window.open(confirmation.php?username=<?php echo $current_user; ?>,"_self")</script>';
      } else {
        echo '<script>alert("Changes were not updated, please try again")</script>';
      }

?>




  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
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
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

      body {
        background-image: linear-gradient(#F89C0E, black);
      }
      .cart {
        height: 100vh
      }
      
      .progresses {
        display: flex;
        align-items: center
      }

      .line {
        width: 76px;
        height: 6px;
        background: #63d19e
      }

      .steps {
        display: flex;
        background-color: #63d19e;
        color: #fff;
        font-size: 12px;
        width: 30px;
        height: 30px;
        align-items: center;
        justify-content: center;
        border-radius: 50%
      }

      .card {
        background-image: linear-gradient(#F89C0E, black);
      }

      .check1 {
        display: flex;
        background-color: #63d19e;
        color: #fff;
        font-size: 17px;
        width: 60px;
        height: 60px;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 10px
      }

      .invoice-link {
        font-size: 15px
      }

      .order-button {
        height: 50px
      }

      .background-muted {
        background-image: linear-gradient(#F89C0E, black);
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
            <li class="nav-item"><a class="nav-link" href="user-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="subscribe.php"><i class="fa fa-fw fa-check"></i> Subscribe</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-fw fa-lock"></i> Log out</a></li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="container mt-4 mb-4 text-white">
      <div class="row d-flex cart align-items-center justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="d-flex justify-content-center border-bottom">
              <div class="p-3">
                <div class="progresses">
                  <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                  <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                  <div class="steps"> <span class="font-weight-bold">3</span> </div>
                </div>
              </div>
            </div>
            <div class="row g-0">
              <div class="col-md-6 border-right p-5">
                <div class="text-center order-details">
                  <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span> <span class="font-weight-bold">Order Confirmed</span> <small class="mt-2">Your subscription has been confirmed!</small> </div>
                </div>
              </div>
              <div class="col-md-6 background-muted">

                <div class="row g-0 border-bottom">
                  <div class="col-md-6 border-right">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subscription</span> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span>x1</span> </div>
                  </div>
                </div>
                <div class="row g-0 border-bottom">
                  <div class="col-md-6">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span>Price</span> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span>$9.99</span> </div>
                  </div>
                </div>
                <div class="row g-0 border-bottom">
                  <div class="col-md-6">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span>Taxes</span> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span>$1.29</span> </div>
                  </div>
                </div>
                <div class="row g-0">
                  <div class="col-md-6">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">$11.28</span> </div>
                  </div>
                </div>
              </div>
            </div>
            <div> </div>
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

  // EOF

}

// EOF

?>