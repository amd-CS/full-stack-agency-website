<?php
require 'config.php';
require 'templates/functions/validation.php';

// Should return a PDO
function db_connect() {

  try {
    // return $pdo;
      $connectionString = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME;
      $user = DBUSER;    $pass = DBPASS;

      // MAKE CONNECTION AND SET UP ERROR STUFF
      $pdo = new PDO($connectionString, $user, $pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;

  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }
}

// Handle form submission
function submit_post() {
  global $pdo;
  global $valid;

  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid)
  {
    // Prepare the submitted form data and insert it to the database
      if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['date']) && isset($_POST['comment'])) {
          //PREPARED statement
          $sql = 'INSERT INTO comments (name, email, date, commentText) VALUES (:name, :email, :date, :comment)';
          $statement = $pdo->prepare($sql);

          $statement->bindValue(':name', $_POST['name']);
          $statement->bindValue(':email', $_POST['email']);
          $statement->bindValue(':date', $_POST['date']);
          $statement->bindValue(':comment', $_POST['comment']);
          $statement->execute();

      }
  }
}

// Get all comments from database and store in $comments
function get_posts() {
  global $pdo;
  global $comments;

    $sql = 'SELECT * FROM comments ORDER BY ID DESC';
    $result = $pdo->query($sql);

    while ($row = $result->fetch()) {
        $comments[] = $row;
    }

}

