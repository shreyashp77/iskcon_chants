<html>

<body>
    <center>
        <div class="cont">
            <h2>View Total Chants</h2>
            <form action="check.php" method="POST">
                <!-- <label for="edadte">Select Date : </label> -->
                <p>Select Date:</p>
                <input type="date" name="edate" id="edate"><br><br>
                <button type="submit" name="submit">Check</button>
            </form>
            <button onclick="document.location = 'dashboard.php'">Back</button>

            <!-- <br>
            <br> -->


            <!-- onclick="document.location = 'check.php'" -->

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
        transform: translateX(-40%) translateY(-50%);
    }
</style>

</html>

<?php

require_once 'source/db_connect.php';
include_once 'source/session.php';





?>