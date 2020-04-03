<?php

require_once 'source/db_connect.php';
include_once 'source/session.php';


if (isset($_POST['submit'])) {
    $edate = strtotime($_POST['edate']);
    $edate = date("Y-m-d", $edate);
    $username = $_SESSION['username'];


    try {
        $query = "SELECT SUM(chants) AS `total` FROM `test`
                   WHERE edate = :edate";

        $statement = $conn->prepare($query);
        $params = array(
            'edate' => $edate
        );

        $statement->execute($params);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $sum = $row['total'];

        $querys = "SELECT SUM(chants) AS `usr_total` FROM `test`
                    WHERE edate = :edate AND uname = :uname";

        $statements = $conn->prepare($querys);
        $paramss = array(
            'edate' => $edate,
            'uname' => $username
        );


        $statements->execute($paramss);
        $rows = $statements->fetch(PDO::FETCH_ASSOC);
        $sums = $rows['usr_total'];
        //$total_data = $statement->fetch();

        //echo $sums;

        // if ($statement->rowCount() > 0)
        //     echo 'Done';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<html>

<head>

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

<body>
    <center>
        <div class="cont" width="100%">
            <?php
            if ($sum != 0) {
                echo '<marquee align = "middle" scrollamount="12"><h3 class="heading">Total rounds on ' . '<strong><mark>' . $edate . '</mark></strong>' . ' are : ' . '<strong><mark>' . $sum . '</mark></strong>' . '</h3></marquee>';
                if ($sums != 0)
                    echo '<h4 class="heading">Your total rounds are : ' . '<strong><mark>' . $sums . '</mark></strong>' . '</h4>';
                else
                    echo '<h4 class="heading">Your total rounds are : ' . '<strong><mark>' . '0' . '</mark></strong>' . '</h4>';
            } else {
                echo '<h3 class="heading">Total rounds on ' . '<strong><mark>' . $edate . '</mark></strong>' . ' are : ' . '<strong><mark>' . '0' . '</mark></strong>' . '</h3>';
            }
            ?>
            <button onclick="document.location = 'total.php'">Back</button>
        </div>
    </center>
</body>

<style>
    .cont {
        position: absolute;
        top: 50%;
        left: 50%;
        vertical-align: middle;
        align-content: center;
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        vertical-align: middle;

    }

    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }



    ​
</style>

</html>