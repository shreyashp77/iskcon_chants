<?php

require_once 'source/db_connect.php';
include_once 'source/session.php';


if (isset($_POST['submit'])) {
    $edate = strtotime($_POST['edate']);
    $edate = date("Y-m-d", $edate);
    $username = $_SESSION['username'];


    try {
        $query = "SELECT SUM(chants) AS `total` FROM `chants`
                   WHERE edate = :edate";

        $statement = $conn->prepare($query);
        $params = array(
            'edate' => $edate
        );

        $statement->execute($params);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $sum = $row['total'];

        $querys = "SELECT SUM(chants) AS `usr_total` FROM `chants`
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

<body>
    <center>
        <div class="cont">
            <?php
            if ($sum != 0) {
                echo '<h3>Total chants on ' . '<strong><mark>' . $edate . '</mark></strong>' . ' are : ' . '<strong><mark>' . $sum . '</mark></strong>' . '</h3>';
                if ($sums != 0)
                    echo '<h4>Your total chants are : ' . '<strong><mark>' . $sums . '</mark></strong>' . '</h4>';
                else
                    echo '<h4>Your total chants are : ' . '<strong><mark>' . '0' . '</mark></strong>' . '</h4>';
            } else {
                echo '<h3>Total chants on ' . '<strong><mark>' . $edate . '</mark></strong>' . ' are : ' . '<strong><mark>' . '0' . '</mark></strong>' . '</h3>';
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
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
    }
</style>

</html>