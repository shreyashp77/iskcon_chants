<?php
$month = date('m');
//echo $month;
// echo "<center><table>";
// echo "<caption class='heading'>Global Count</caption><tr><th>Name</th><th>Total Rounds</th></tr>";

// class TableRows extends RecursiveIteratorIterator
// {
//     function __construct($it)
//     {
//         parent::__construct($it, self::LEAVES_ONLY);
//     }

//     function current()
//     {
//         return "<td>" . parent::current() . "</td>";
//     }

//     function beginChildren()
//     {
//         echo "<tr>";
//     }

//     function endChildren()
//     {
//         echo "</tr>" . "\n";
//     }
// }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iskcon";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $stmt = $conn->prepare("SELECT uname, total FROM total");
//     $stmt->execute();

//     // set the resulting array to associative
//     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
//         echo $v;
//     }
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }
// //$conn = null;
// echo "</table></center>";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully<br>";


$query = "SELECT uname, total FROM total";
$queryResult = $conn->query($query);
echo "<center><table>";
echo "<caption class='heading'>Global Count</caption><tr><th>Name</th><th>Total Rounds</th><th>Action</th></tr>";
while ($queryRow = $queryResult->fetch_row()) {
    echo "<tr>";
    for ($i = 0; $i < $queryResult->field_count + 1; $i++) {
        if ($i == $queryResult->field_count) {
            echo "<td><form action='userwise.php' method='POST'>
            <input type='hidden' name='uname' value='$queryRow[0]' />
                            <button id='submit' type='submit' name='submit' class='button' id='action'>See Detailed Count</button>
                        </form></td>";
        } else
            echo "<td>$queryRow[$i]</td>";
    }
    echo "</tr>";
}
echo "</table>";
//$conn->close();












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
            /* width: 150px; */
            font-size: 12px;
            font-weight: bold;
            /* padding: 12px 45px; */
            letter-spacing: 1px;
            /* text-transform: uppercase; */
            transition: transform 80ms ease-in;
        }



        #action {
            padding: 15px 25px;

        }

        #back {
            border-radius: 20px;
            padding: 12px 45px;
            text-transform: uppercase;
        }

        .button {
            background-color: white;
            color: black;
            border: 1px solid #FF4B2B;
            padding: 10px 20px;
        }



        /* #detailed {
            width: 243px;
        }

        #back {
            width: 140px;
            text-align: center;
            margin: auto;
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
    </style>

</head>

<body>
    <center>
        <br>
        <button id="back" onclick="document.location = 'dashboard.php'">Back</button><br><br>

    </center>

</body>

</html>