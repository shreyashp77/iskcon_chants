<?php

require_once 'source/db_connect.php';
include_once 'source/session.php';


if (isset($_POST['submit'])) {

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $edate = strtotime($_POST['edate']);
    $edate = date("Y-m-d", $edate);
    $chants = $_POST['num'];

    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $SQLInsert = "INSERT INTO chants (uname, email, edate, chants)
                   VALUES (:username, :email, :edate, :chants)";

        $statement = $conn->prepare($SQLInsert);
        $statement->execute(array(':username' => $username, ':email' => $email, ':edate' => $edate, ':chants' => $chants));

        // if ($statement->rowCount() == 1) {
        //     header('location: index.html');
        // }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<html>
<center>
    <div class="cont">
        <h2>Thank You!</h2>
        <p>Your response has been recorded.</p>
        <button onclick="document.location = 'total.php'">See Total Counts</button>
        <button onclick="document.location = 'dashboard.php'">Back</button>
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