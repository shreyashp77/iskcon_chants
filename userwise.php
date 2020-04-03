<?php
$month = date('m');
//echo $month;
echo "<center><table>";
echo "<caption class='heading'>User wise count</caption><tr><th>Name</th><th>Date</th><th>Rounds</th></tr>";

class TableRows extends RecursiveIteratorIterator
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current()
    {
        return "<td>" . parent::current() . "</td>";
    }

    function beginChildren()
    {
        echo "<tr>";
    }

    function endChildren()
    {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iskcon";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT uname, edate, chants FROM test WHERE `uname` = :uname");
    $stmt->execute(array(':uname' => $_POST['uname']));


    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
        echo $v;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
//$conn = null;
echo "</table></center>";


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

// echo 'name : ' . $nm . '<br>';
// echo 'rounds : ' . $count . '<br>';




?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">

    <style>
        .heading {
            /* font-family: 'Sen', sans-serif; */
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 30px;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            width: 150px;
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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #FF4B2B;
            color: white;
        }
    </style>

</head>

<body>
    <center>
        <br><button onclick="document.location = 'dashboard.php'">Home</button><br><br>
        <button onclick="document.location = 'userwise_total.php'">Back</button><br><br>
    </center>

</body>

</html>