<?php

session_start();
if (isset($_SESSION["user-username"])) {
    
    require_once "Include/db.php";

    // shows the existing data in the table
    $SearchQuery = $_GET["id"]; 
    $bookName;
    $available = 1;

    global $ConnectingDB;
    $sql2 = "SELECT * from user_items WHERE id='$SearchQuery'";
    $stmt = $ConnectingDB->query($sql2);
    while ($DataRows = $stmt->fetch()){
        $bookName = $DataRows["item"];
    }

    $sql3 = "UPDATE catalog SET available='$available' WHERE name='$bookName'";
    $ExecuteCatalog = $ConnectingDB->query($sql3);

    $sql = "DELETE FROM user_items WHERE id='$SearchQuery'";
    $Execute = $ConnectingDB->query($sql);

    
    if ($Execute && $ExecuteCatalog) {
        
        /**
         * sends the user back to the table 
         * _self is so it won't open in a new window
         */
    
        echo '<script>window.open("user-catalog.php?id=Record Deleted Successfully","_self")</script>';
    }

?>

<?php 

} else {
    header("Location: index.php");

    // EOF

} ?>