<?php

session_start();
if (isset($_SESSION["employee-username"]) || isset($_SESSION["user-username"])) {

    // needs to connect to database
    require_once "Include/db.php";
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
                        <?php

                        // if employee logged in
                        if (isset($_SESSION["employee-username"])) {

                        ?>
                            <li class="nav-item"><a class="nav-link" href="insert-into-database.php"><i class="fa fa-fw fa-plus"></i> Insert</a></li>
                            <li class="nav-item"><a class="nav-link active" href="view-catalog.php"><i class="fa fa-fw fa-search"></i> Catalog</a></li>
                            <li class="nav-item"><a class="nav-link" href="employee-profile.php"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="view-employee.php"><i class="fa fa-fw fa-group"></i> Employees</a></li>
                        <?php

                            // if customer logged in
                        } else {

                        ?>
                            <li class="nav-item"><a class="nav-link active" href="view-catalog.php"><i class="fa fa-fw fa-search"></i> Catalog</a></li>
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

            <div class="intro-content">
                <div class="container">
                    <h2 class="success">
                        <!-- @ - won't show error when there is no id -->
                        <?php echo @$_GET["id"]; ?>
                    </h2>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ms-auto">
                            <fieldset class="float-md-end">
                                <form class="" action="view-catalog.php" method="GET">
                                    <input class="search-text-field" type="text" name="search" value="" placeholder="Search by name or isbn">
                                    <input class="search-submit btn btn-warning btn-md mr-lg-2" type="submit" name="searchBtn" value="Search record">
                                </form>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row sort-row">
                        <div class="col-md-12 ms-auto">
                            <form class="float-md-end" action="view-catalog.php" method="POST">
                                <div class="col-md-12 ms-auto">
                                    <label>Sort By: Name</label>
                                    <select name="sort-name">
                                        <option value='SORT_ASC'>By Ascending Order</option>
                                        <option value='SORT_DESC'>By Decending Order</option>
                                    </select>
                                </div>
                                <div class="my-2"></div>
                                <div class="col-md-12 ms-auto">
                                    <label>Sort By: Type</label>
                                    <select name="sort-type">
                                        <option value="all">By All</option>
                                        <option value="book">By Book </option>
                                        <option value="games">By Games</option>
                                        <option value="music">By Music</option>
                                    </select>

                                </div>
                                <input class="btn btn-warning btn-md mr-lg-2" type="submit" name="sort-submit" value="Sort">
                            </form>
                        </div>

                    </div>

                    <?php


                    if (isset($_GET["searchBtn"])) {
                        global $ConnectingDB;
                        $Search = $_GET["search"];
                        $sql = "SELECT * FROM catalog WHERE (`name` LIKE '%" . $Search . "%') OR (`isbn`= '$Search')";
                        $stmt = $ConnectingDB->prepare($sql);
                        // $stmt->bindValue(':searcH', );
                        $stmt->execute();

                        while ($DataRows = $stmt->fetch()) {
                            $Id                 = $DataRows["id"];
                            $Name               = $DataRows["name"];
                            $Author_dev_artist  = $DataRows["author_dev_artist"];
                            $ISBN               = $DataRows["isbn"];
                            $Available          = "No";
                            if ($DataRows["available"]) {
                                $Available = "Yes";
                            }
                            $Type               = $DataRows["type"];

                    ?>
                            <div>
                                <table width="1000" border="5" align="center">
                                    <!-- <h3 align="center">Search Result</h3> -->
                                    <tr>
                                        <th>Name</th>
                                        <th>Author | Dev | Artist</th>
                                        <th>Type</th>
                                        <th>ISBN</th>
                                        <th>View Item</th>
                                        <th>Available</th>
                                        <?php if (isset($_SESSION["employee-username"])) { ?>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        <?php
                                        } ?>
                                        <th>Search Again</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $Name; ?></td>
                                        <td><?php echo $Author_dev_artist; ?></td>
                                        <td><?php echo $Type; ?></td>
                                        <td><?php echo $ISBN; ?></td>
                                        <td><a class="btn btn-warning btn-md mr-lg-2" href="view-item.php?id=<?php echo $Id ?>">Item Link</a></td>
                                        <td><?php echo $Available; ?></td>
                                        <?php if (isset($_SESSION["employee-username"])) { ?>
                                            <td><a class="btn btn-warning btn-md mr-lg-2" href="edit.php?id=<?php echo $Id ?>">Edit</a></td>
                                            <td><a class="btn btn-warning btn-md mr-lg-2" href="delete.php?id=<?php echo $Id ?>">Delete</a></td>
                                        <?php
                                        } ?>
                                        <td> <a class="btn btn-warning btn-md mr-lg-2" href="view-catalog.php">Search Again</a> </td>
                                    </tr>
                                </table>
                            </div>

                    <?php }
                    }
                    ?>

                    <?php
                    if (!isset($_GET["searchBtn"])) {
                    ?>
                        <table width="1000" border="5" align="center">
                            <h2 align="center">View from Database</h2>
                            <tr>
                                <th>Name</th>
                                <th>Author | Dev | Artist</th>
                                <th>Type</th>
                                <th>ISBN</th>
                                <th>View Item</th>
                                <th>Available</th>
                                <?php if (isset($_SESSION["employee-username"])) {
                                ?>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                <?php
                                } ?>
                            </tr>


                            <?php


                            global $ConnectingDB;

                            $sort_asc_dec = "SORT_ASC";
                            $sortType = "all";
                            if (isset($_POST["sort-submit"])) {
                                $sort_asc_dec = $_POST["sort-name"];
                                $sortType = $_POST["sort-type"];
                            }


                            $sql = "SELECT * From catalog";
                            $stmt = $ConnectingDB->query($sql);
                            $listOfList = array();
                            while ($DataRows = $stmt->fetch()) {
                                $Id                 = $DataRows["id"];
                                $Name               = $DataRows["name"];
                                $Author_dev_artist  = $DataRows["author_dev_artist"];
                                $ISBN               = $DataRows["isbn"];
                                $Available          = "No";
                                if ($DataRows["available"]) {
                                    $Available = "Yes";
                                }
                                $Type               = $DataRows["type"];

                                array_push($listOfList, array('id' => $Id, 'name' => $Name, 'author_dev_artist' => $Author_dev_artist, 'type' => $Type, 'isbn' => $ISBN, 'available' => $Available));
                            }

                            $allNames = array_column($listOfList, 'name');
                            if ($sort_asc_dec == "SORT_DESC") {
                                array_multisort($allNames, SORT_DESC, $listOfList);
                            } else {
                                array_multisort($allNames, SORT_ASC, $listOfList);
                            }


                            foreach ($listOfList as $value) {
                                $Id = $value['id'];
                                $Name = $value['name'];
                                $Author_dev_artist = $value['author_dev_artist'];
                                $Type = $value['type'];
                                $ISBN = $value['isbn'];
                                $Available = $value['available'];

                                if ($Type == $sortType || $sortType == "all") {

                            ?>
                                    <tr>
                                        <td><?php echo $Name; ?></td>
                                        <td><?php echo $Author_dev_artist; ?></td>
                                        <td><?php echo $Type; ?></td>
                                        <td><?php echo $ISBN; ?></td>
                                        <td><a class="btn btn-warning btn-md mr-lg-2 my-1" href="view-item.php?id=<?php echo $Id ?>">Item Link</a></td>
                                        <td><?php echo $Available; ?></td>
                                        <?php if (isset($_SESSION["employee-username"])) {
                                        ?>
                                            <td><a class="btn btn-warning btn-md mr-lg-2" href="edit.php?id=<?php echo $Id ?>">Edit</a></td>
                                            <td><a class="btn btn-warning btn-md mr-lg-2" href="delete.php?id=<?php echo $Id ?>">Delete</a></td>
                                        <?php
                                        } ?>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </table>
                        <?php
                        if (isset($_SESSION["user-username"])) {
                            echo '<a class="btn btn-warning btn-md mr-lg-2" href="user-catalog.php">View Rentals</a>
                        </div>';
                        }
                        ?>
                </div>
            </div>
        </div>
        <div class="copyright py-4 text-center text-white">
            <div class="container"><span>Copyright &copy; Digi Lib 2022</span></div>
        </div>
    </body>

    </html>

<?php
                    }
                } else {
                    header("Location: index.php");
                } ?>

<!-- EOF -->