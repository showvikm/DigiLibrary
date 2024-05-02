<?php

session_start();

if (isset($_SESSION["employee-username"])) {

// needs to connect to database
require_once "Include/db.php" ;
$currentuser = $_SESSION["employee-username"];


if (isset($_POST["Submit"])) {
    if (!empty($_POST["name"]) && !empty($_POST["author-dev-artist"]) && !empty($_POST["type"]) && !empty($_POST["isbn"]) &&
    !empty($_POST["available"]) && !empty(strval($_POST["imageLink"])) && !empty(strval($_POST["itemLink"]))) {
        $Name = $_POST["name"];
        $author_dev_artist = $_POST["author-dev-artist"];
        $type = strtolower($_POST["type"]);
        $isbn = $_POST["isbn"];
        $available = $_POST["available"];
        if ($available == "yes") {
            $available = 1;
        }else {
            $available = 0;
        }
        $imageLink = strval($_POST["imageLink"]);
        $itemLink = strval($_POST["itemLink"]);

        global $ConnectingDB;
        if(strlen($isbn) == 13){
            $sql = "INSERT INTO catalog(name, author_dev_artist, isbn, available, image_link, item_link, type) VALUES(:namE, :authorDevArtisT, :isbN, :availablE, :imagelinK, :itemlinK, :typE)";
                    $stmt = $ConnectingDB->prepare($sql);
                    $stmt->bindValue(':namE', $Name);
                    $stmt->bindValue(':authorDevArtisT', $author_dev_artist);
                    $stmt->bindValue(':isbN', $isbn);
                    $stmt->bindValue(':availablE', $available);
                    $stmt->bindValue(':imagelinK', $imageLink);
                    $stmt->bindValue(':itemlinK', $itemLink);
                    $stmt->bindValue(':typE', $type);

            $Execute = $stmt->execute();
            if ($Execute) {
                echo '<script> alert("Record Has Added Successfully")</script>';
            }
        }else {
            echo '<script>alert("ISBN has to be 13 digits")</script>';
        }
        
    } else {
        echo '<script> alert("Please add Name and And other fields")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert into Catalog</title>
    <link rel="icon" type="image/png" href="library.png" sizes="16x16"/>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="Include/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" async>
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
            <li class="nav-item"><a class="nav-link active" href="insert-into-database.php"><i class="fa fa-fw fa-plus"></i> Insert</a></li>
            <li class="nav-item"><a class="nav-link" href="view-catalog.php"><i class="fa fa-fw fa-search"></i> Catalog</a></li>
            <li class="nav-item"><a class="nav-link" href="employee-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
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
                <div class="box">
                    <form class="" action="insert-into-database.php" method="POST">
                        <div class="input-group">
                            <span class="FieldInfo">Name:</span>                        
                            <input class="inp" type="text" name="name" value="">
                        </div>
                        
                        
                        <div class="input-group">
                            <span class="FieldInfo">Author | Dev | Artist:</span>                        
                            <input class="inp" type="text" name="author-dev-artist" value="">
                        </div>
                        
                        
                        <div class="input-group">
                            <span class="FieldInfo">Type:</span>                        
                            <!-- <input class="inp" type="text" name="type" value=""> -->
                            <select class="inp" name="type">
                                <option value = "book">Book</option>
                                <option value = "games">Games</option>
                                <option value = "music">Music</option>
                            </select>
                        </div>
                        
                        
                        <div class="input-group">
                            <span class="FieldInfo">ISBN</span>                        
                            <input class="inp" type="text" name="isbn" placeholder="Must be 13 digit"value="">
                        </div>
                        
                        
                        <div class="input-group">
                            <span class="FieldInfo">Available</span>
                            <select class="inp" name="available">
                                <option value = "yes">Yes</option>
                                <option value = "no">No</option>
                            </select>
                        </div>
                        
                        
                        <div class="input-group">
                            <span class="FieldInfo">Image Upload</span>
                            <input class="inp" type="file" name="imageLink" accept="image/*">
                        </div>
                        
                        
                        <div class="input-group">
                            <span class="FieldInfo">Item Upload</span>                        
                            <input class="inp" type="file" name="itemLink" accept=".pdf, audio/*">
                        </div>
                        
                        
                        <div class="input-group">
                            <input class="inp submit-inp btn btn-warning btn-lg mr-lg-2" type="submit" name="Submit" value="Update your record">
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
    header("Location: index.php");
} ?>

<!-- EOF -->
