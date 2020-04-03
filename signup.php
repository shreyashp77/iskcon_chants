<?php

require_once 'source/db_connect.php';

if (isset($_POST['signup-btn'])) {

  $username = $_POST['user-name'];
  $email = $_POST['user-email'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  //$password = $_POST['user-pass'];

  //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

  try {
    $SQLInsert = "INSERT INTO users (username, email, city, country, to_date)
                   VALUES (:username, :email, :city, :country, now())";

    $statement = $conn->prepare($SQLInsert);
    $statement->execute(array(':username' => $username, ':email' => $email, ':city' => $city, ':country' => $country));

    if ($statement->rowCount() == 1) {
      header('location: index.html');
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
