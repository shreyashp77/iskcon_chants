<?php

include_once 'source/session.php';
require_once 'source/db_connect.php';

$datenow = date("Y-m-d");


try {
    $query = "SELECT * FROM test where edate = :edate ORDER BY `chants` DESC limit 1";

    $statement = $conn->prepare($query);
    $params = array(
        'edate' => $datenow
    );

    $statement->execute($params);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $nm = $row['uname'];
    $count = $row['chants'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- <title>FashON! | Spice up your Wardrobe</title> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->

    <style>
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            -moz-transform: translateX(-50%) translateY(-50%);
            -webkit-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }

        .heading {
            /* font-family: 'Sen', sans-serif; */
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            /* width: 221px; */
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        /* #submit {
            width: 180px;
        } */

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        .round {
            border-radius: 20px;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 221px;
        }
    </style>



</head>

<body style="background-color:#FFFFFF;">

    <?php if (!isset($_SESSION['username'])) : header("location: logout.php"); ?>

    <?php else : ?>

    <?php endif ?>

    <?php
    $datenow = date("Y-m-d");
    try {
        $query = "SELECT SUM(chants) AS `total` FROM `test`
                           WHERE edate = :edate";

        $statement = $conn->prepare($query);
        $params = array(
            'edate' => $datenow
        );

        $statement->execute($params);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $sum = $row['total'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <center>
        <div class="container">
            <h2 class="heading">ISKCON Japa</h2>
            <br>
            <?php
            if ($sum != 0) {
                echo '<marquee align = "middle" scrollamount="12"><h3 class="heading">Total rounds today are : '   . '<strong>' . $sum . '</strong>' . ' Top contributor : ' . '<strong>' . $nm . '</strong>' . '</h3></marquee>';
            } else {
                echo '<marquee align = "middle" scrollamount="12"><h3 class="heading">Total rounds on ' . '<strong>' . date("d/m/Y") . '</strong>' . ' are : ' . '<strong>' . '0' . '</strong>' . '</h3></marquee>';
            }
            ?>
            <?php echo "<h5> Hello " . $_SESSION['username'] . "! </h5>" ?>

            <?php //echo "<h6> Date: " . $datenow . "! </h5>" 
            ?>
            <h6>Please enter the following details:</h6>
            <form action="post_data.php" method="POST">
                <!-- <label for="chants">Total Rounds:</label><br> -->
                <input type="number" class="round" id="num" name="num" placeholder="Total Rounds"><br>
                <!-- <label for="lname">Date:</label><br> -->
                <input type="date" class="round" id="edate" name="edate" placeholder="date"><br><br>
                <input type="hidden" name="form_submitted" value="1" />
                <button id="submit" type="submit" name="submit" value="send to database" class="button"> Submit</button>
            </form><br>
            <button id="count" onclick="document.location = 'userwise_total.php'">Global count</button><br><br>
            <!-- <button class="button" onclick="document.location = 'total.php'">See Total Rounds</button><br><br> -->
            <button id="logout" class="button" onclick="document.location = 'logout.php'">Logout</button>
        </div>

    </center>


</body>

</html>