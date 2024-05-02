<?php

session_start();
if (isset($_SESSION["user-username"])) {

    // needs to connect to database
    require_once "Include/db.php";
    global $current_user;
    $current_user = $_SESSION["user-username"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Catalog</title>
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
                        <li class="nav-item"><a class="nav-link active" href="view-catalog.php"><i class="fa fa-fw fa-search"></i>
                                Catalog</a></li>
                        <li class="nav-item"><a class="nav-link" href="user-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="subscribe.php"><i class="fa fa-fw fa-check"></i> Subscribe</a>
                        </li>
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
                    <h2 class="success">
                        <!-- @ - won't show error when there is no id -->
                        <?php echo @$_GET["id"]; ?>
                    </h2>



                    <?php
                    if (!isset($_GET["searchBtn"])) {
                    ?>
                        <table width="1000" border="5" align="center">
                            <h2 align="center">Rented Items</h2>
                            <tr>
                                <th>User</th>
                                <th>Title</th>
                                <th>View Item</th>
                                <th>Delete Item</th>
                            <?php
                        } ?>
                            </tr>


                            <?php


                            global $ConnectingDB;


                            $sql = "SELECT * From user_items WHERE username='$current_user'";
                            $stmt = $ConnectingDB->query($sql);
                            $listOfList = array();
                            while ($DataRows = $stmt->fetch()) {
                                $Id                 = $DataRows["id"];
                                $username               = $DataRows["username"];
                                $item  = $DataRows["item"];
                                $catalog_id = $DataRows["catalog_id"];

                                array_push($listOfList, array('id' => $Id, 'username' => $username, 'item' => $item, 'catalog_id' => $catalog_id));
                            }




                            foreach ($listOfList as $value) {
                                $Id = $value['id'];
                                $username = $value['username'];
                                $item = $value['item'];
                                $catalog_id = $value['catalog_id'];
                            ?>
                                <tr>

                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $item; ?></td>
                                    <td><a class="btn btn-warning btn-md mr-lg-2 my-1" href="view-item.php?id=<?php echo $catalog_id ?>">Item Link</a></td>
                                    <td>
                                        <a class="btn btn-warning btn-md mr-lg-2 my-1" href="delete-item.php?id=<?php echo $Id; ?>">Delete Item</a>

                                    </td>



                                </tr>
                            <?php
                            }
                            ?>
                        </table>
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
