<?php

include_once 'source/session.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- <title>FashON! | Spice up your Wardrobe</title> -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->



</head>

<body>

    <?php if (!isset($_SESSION['username'])) : header("location: logout.php"); ?>

    <?php else : ?>

    <?php endif ?>


    <center>
        <div class="container">
            <h2>ISKCON Chants</h2>
            <br>
            <?php echo "<h6> Hello " . $_SESSION['username'] . "! </h6>" ?>
            <form action="post_data.php" method="POST">
                <label for="chants">Total Chants:</label><br>
                <input type="number" id="num" name="num"><br>
                <label for="lname">Date:</label><br>
                <input type="date" id="edate" name="edate"><br><br>
                <input type="hidden" name="form_submitted" value="1" />
                <button type="submit" name="submit" value="send to database"> Submit</button>
            </form><br>
            <button onclick="document.location = 'total.php'">See Total Chants</button><br><br>
            <button onclick="document.location = 'logout.php'">Logout</button>
        </div>

    </center>



    <style>
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            -moz-transform: translateX(-50%) translateY(-50%);
            -webkit-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }
    </style>


    <?php
    $connect = mysqli_connect("localhost", "root", "", "fashon_users");
    include_once 'source/session.php';





    ?>





























</body>

</html>