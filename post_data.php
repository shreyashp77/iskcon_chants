<?php

require_once 'source/db_connect.php';
include_once 'source/session.php';


if (isset($_POST['submit'])) {

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $edate = strtotime($_POST['edate']);
    $edate = date("Y-m-d", $edate);
    // $month = $edate->format('m');
    //$month = date("m", $edate);
    date_default_timezone_set('Asia/Kolkata');
    $etime = date('h:i:s');
    $chants = $_POST['num'];

    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $SQLInsert = "INSERT INTO test (uname, email, edate, chants)
                   VALUES (:username, :email, :edate, :chants) ON DUPLICATE KEY UPDATE `chants` = :chants";

        $statement = $conn->prepare($SQLInsert);
        $statement->execute(array(':username' => $username, ':email' => $email, ':edate' => $edate, ':chants' => $chants));

        // if ($statement->rowCount() == 1) {
        //     header('location: index.html');
        // }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    try {
        $SQLInsert = "INSERT INTO total (uname, total)
                   VALUES (:username, :chants) ON DUPLICATE KEY UPDATE `total` = `total` + :chants";

        $statement = $conn->prepare($SQLInsert);
        $statement->execute(array(':username' => $username, ':chants' => $chants));

        // if ($statement->rowCount() == 1) {
        //     header('location: index.html');
        // }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
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

        /* .button {
            display: inline-block;
            border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 15px;
            padding: 10px;
            width: 150px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        } */
        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            width: 221px;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

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
<center>
    <div class="cont">
        <?php echo '<h2 class="heading"> Thank You ' . $_SESSION['username'] . '! </h2>' ?>
        <!-- <h2>Thank You!</h2> -->
        <h3 class="heading">Your response has been recorded.</h3>
        <button onclick="document.location = 'total.php'">See Total Counts</button><br><br>
        <button onclick="document.location = 'dashboard.php'">Back</button><br><br>
        <button onclick="document.location = 'logout.php'">Logout</button>


    </div>

</center>

<style>
    .cont {
        position: absolute;
        top: 50%;
        left: 50%;
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
    }
</style>

</html>