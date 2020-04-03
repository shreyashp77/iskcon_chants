<?php

require_once 'source/session.php';
require_once 'source/db_connect.php';

if (isset($_POST['login-btn'])) {

  $useremail = $_POST['useremail'];
  //$password = $_POST['user-pass'];

  try {
    $SQLQuery = "SELECT * FROM users WHERE email = :useremail";
    $statement = $conn->prepare($SQLQuery);
    $statement->execute(array(':useremail' => $useremail));

    while ($row = $statement->fetch()) {
      $id = $row['id'];
      $email = $row['email'];
      //$hashed_password = $row['password'];
      $username = $row['username'];

      //if(password_verify($password, $hashed_password)) {
      if ($useremail == $email) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header('location: dashboard.php');
      } else {
        header('location: error.php');
      }
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
