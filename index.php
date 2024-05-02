<?php

/**
 * The home Screen of the page.
 */

session_start();

// if user or employee is logged in
if (isset($_SESSION["user-username"]) || isset($_SESSION["employee-username"])) {

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async></script>
    <link rel="stylesheet" href="Include/style.css">

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

    <title>Digi Lib</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16">
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
            <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
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
              <li class="nav-item"><a class="nav-link" href="subscribe.php"><i class="fa fa-fw fa-check"></i> Subscription</a></li>
            <?php

            }

            ?>
            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-fw fa-lock"></i> Log out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="intro position-relative text-white">
      <div class="home-bg">
        <img class="img-fluid img-cover" src="Images/home-bg.jpg" alt="Library">
      </div>
      <div class="intro-content">
        <div class="container">
          <div class="text-center">
            <div class="row align-items-center">
              <div class="col-9 mx-auto text-center">
                <h1 class="my-3 display-4 d-none d-lg-inline-block">Digi Lib - The Best Digital Library</h1>
              </div>
            </div>

            <div class="row align-items-center">
              <div class="col-6 mx-auto text-center">
                <p class="lead mb-3">Digi Lib is an online library system that supports monthly subscriptions which gives users access to the library's exclusive content!</p>
                <a class="btn btn-warning btn-lg mr-lg-2 my-1" href="view-catalog.php" role="button">View Catalog</a>
              </div>
            </div>
          </div>
          <div class="border-top border-white-10 my-10"></div>

          <div class="row">
            <div class="col-sm mb-5 mb-sm-0">
              <!-- Rating -->
              <div class="d-flex gap-1 mb-2">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
              </div>
              <!-- End Rating -->

              <blockquote class="blockquote blockquote-sm text-white mb-4">“ Very user-friendly and easy to manage. ”</blockquote>
              <p>- Bill Smith</p>
            </div>
            <!-- End Col -->

            <div class="col-sm mb-5 mb-sm-0">
              <!-- Rating -->
              <div class="d-flex gap-1 mb-2">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star-half.svg" alt="Review rating" width="16">
              </div>
              <!-- End Rating -->

              <blockquote class="blockquote blockquote-sm text-white mb-4">“ The monthly subscription is worth it. ”</blockquote>

              <p>- Albert David</p>
            </div>
            <!-- End Col -->

            <div class="col-sm mb-5">
              <!-- Rating -->
              <div class="d-flex gap-1 mb-2">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star-half.svg" alt="Review rating" width="16">
              </div>
              <!-- End Rating -->

              <blockquote class="blockquote blockquote-sm text-white mb-4">“ This library is everything a professor wants. ”</blockquote>

              <p>- Joe Yan</p>
            </div>
            <!-- End Col -->
          </div>
        </div>
      </div>
    </div>
    <div class="my-10"></div>
    <div class="content">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <img src="Images/tick.jpg" alt="Subscribe" />
            </span>
            <h4 class="my-3">Monthly Subscription</h4>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <img src="Images/manage.jpg" alt="Manageable" />
            </span>
            <h4 class="my-3">User-Friendly Design</h4>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <img src="Images/lock.jpg" alt="Lock" />
            </span>
            <h4 class="my-3">Web Security</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="my-10"></div>
    <div class="copyright py-4 text-center text-white">
      <div class="container"><span>Copyright &copy; Digi Lib 2022</span></div>
    </div>
  </body>

  </html>


<?php

  // if not logged in
} else {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async></script>
    <link rel="stylesheet" href="Include/style.css">

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

    <title>Digi Lib</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16" />
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
            <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-fw fa-user"></i> Login</a></li>
            <li class="nav-item"><a class="nav-link" href="signup.php"><i class="fa fa-fw fa-user"></i> Signup</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="intro position-relative text-white">
      <div class="home-bg">
        <img class="img-fluid img-cover" src="Images/home-bg.jpg" alt="Library">
      </div>
      <div class="intro-content">
        <div class="container">
          <div class="text-center">
            <div class="row align-items-center">
              <div class="col-9 mx-auto text-center">
                <h1 class="my-3 display-4 d-none d-lg-inline-block">Digi Lib - The Best Digital Library</h1>
              </div>
            </div>

            <div class="row align-items-center">
              <div class="col-6 mx-auto text-center">
                <p class="lead mb-3">Digi Lib is an online library system that supports monthly subscriptions which gives users access to the library's exclusive content!</p>
                <a class="btn btn-warning btn-lg mr-lg-2 my-1" href="signup.php" role="button">Become a Member</a>
              </div>
            </div>
          </div>
          <div class="border-top border-white-10 my-10"></div>

          <div class="row">
            <div class="col-sm mb-5 mb-sm-0">
              <!-- Rating -->
              <div class="d-flex gap-1 mb-2">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
              </div>
              <!-- End Rating -->

              <blockquote class="blockquote blockquote-sm text-white mb-4">“ Very user-friendly and easy to manage. ”</blockquote>
              <p>- Bill Smith</p>
            </div>
            <!-- End Col -->

            <div class="col-sm mb-5 mb-sm-0">
              <!-- Rating -->
              <div class="d-flex gap-1 mb-2">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star-half.svg" alt="Review rating" width="16">
              </div>
              <!-- End Rating -->

              <blockquote class="blockquote blockquote-sm text-white mb-4">“ The monthly subscription is worth it. ”</blockquote>

              <p>- Albert David</p>
            </div>
            <!-- End Col -->

            <div class="col-sm mb-5">
              <!-- Rating -->
              <div class="d-flex gap-1 mb-2">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star.svg" alt="Review rating" width="16">
                <img src="Images/star-half.svg" alt="Review rating" width="16">
              </div>
              <!-- End Rating -->

              <blockquote class="blockquote blockquote-sm text-white mb-4">“ This library is everything a professor wants. ”</blockquote>

              <p>- Joe Yan</p>
            </div>
            <!-- End Col -->
          </div>
        </div>
      </div>
    </div>
    <div class="my-10"></div>
    <div class="content">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <img src="Images/tick.jpg" alt="Subscribe" />
            </span>
            <h4 class="my-3">Monthly Subscription</h4>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <img src="Images/manage.jpg" alt="Manageable" />
            </span>
            <h4 class="my-3">User-Friendly Design</h4>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <img src="Images/lock.jpg" alt="Lock" />
            </span>
            <h4 class="my-3">Web Security</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="my-10"></div>
    <div class="copyright py-4 text-center text-white">
      <div class="container"><span>Copyright &copy; Digi Lib 2022</span></div>
    </div>

  </body>

  </html>


<?php

}

// EOF

?>