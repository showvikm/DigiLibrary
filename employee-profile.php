<?php
session_start();
if (isset($_SESSION["employee-username"])) {
// needs to connet to database
  require_once "Include/db.php";
  $currentuser = $_SESSION["employee-username"];

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Profile</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16"/>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="Include/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async>
    </script>
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
            <li class="nav-item"><a class="nav-link" href="insert-into-database.php"><i class="fa fa-fw fa-plus"></i> Insert</a></li>
            <li class="nav-item"><a class="nav-link" href="view-catalog.php"><i class="fa fa-fw fa-search"></i> Catalog</a></li>
            <li class="nav-item"><a class="nav-link active" href="employee-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="view-employee.php"><i class="fa fa-fw fa-group"></i> Employees</a></li>
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
                $sql = "SELECT * From employee_accounts WHERE username='$currentuser'";
                $stmt = $ConnectingDB->query($sql);
                while ($DataRows = $stmt->fetch()) {
                  $Id             = $DataRows["id"];
                  $Name           = $DataRows["name"];
                  $username       = $DataRows["username"];
                  $password       = $DataRows["password"];
                }

              ?>
              
              <!-- <form action="editUser.php" method="GET"></form> -->
              <div class="user-profile row">
                <div class="col-md-6">
                  <label for="Name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="Name" name="Name placeholder=" John" value="<?php echo $Name; ?>" disabled />
                </div>
                <div class="col-md-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="jsmith" value="<?php echo $username; ?>" disabled />
                </div>
                <div class="col-md-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" disabled/>
                </div>
              

                <div class="container">
                  <div class="row justify-content-start">
                    <div class="col-4">
                      <button type="submit" class="btn btn-warning btn-lg mr-lg-2"><a class="text-decoration-none text-white" href="edit-employee-profile.php?id=<?php echo $Id; ?>">Edit</a></button>
                    </div>
                  </div>
                </div>
              <!-- </form> -->
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
}

//EOF 

?>
