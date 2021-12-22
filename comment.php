<?php

	// error reporting
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    // array of posts, fetched from database
    $posts = [];

	// Import functions
    require_once 'database/database.php';
	require_once('templates/functions/validation.php');
    require_once 'templates/functions/template_functions.php';

    // Validate form submission
    validate();

    //connect to database: PHP Data object representing Database connection
    $pdo = db_connect();

    // submit comment to database
    submit_post();

    // get posts from database
    get_posts();

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accommodation Rental - Send Comment</title>
    <link rel="stylesheet" href="style.css" />
    <script src="jquery-validation-1.19.3/lib/jquery.js"></script>
    <script src="jquery-validation-1.19.3/dist/jquery.validate.js"></script>
    <script>
        document.addEventListener('keypress', function (e){
            if (!$(e.target).is("input, textarea")) {
                if (e.key === 'h' || e.key === 'H') {
                    document.querySelectorAll('nav ul li a')[0].focus();
                }

                if (e.key === 't' || e.key === 'T') {
                    document.querySelectorAll('nav ul li a')[1].focus();
                }

                if (e.key === 's' || e.key === 'S') {
                    document.querySelectorAll('nav ul li a')[2].focus();
                }

                if (e.key === 'd' || e.key === 'D') {
                    document.querySelectorAll('nav ul li a')[3].focus();
                }
            }
        });

      $(function () {
        $("form").validate({
          rules: {
            name: {
              required: true,
            },

            email: {
              required: true,
              email: true,
            },

            date: {
              required: true,
              dateISO: true,
            },

            comment: {
              required: true,
            },
          },

          messages: {
            name: {
              required: "Please enter your name",
            },

            email: {
              required: "Please provide an email",
              email: "Please enter a valid email address",
            },

            date: {
              required: "Please provide a date",
              dateISO: "Date must be in ISO format",
            },

            comment: {
              required: "Please write a comment",
            },
          },

          // This is the function that submits the form if there are no errors
          submitHandler: function (form) {
            form.submit();
          },
        });
      });
    </script>

  </head>

  <body>
    <header>TRAVEL WITH US!</header>

    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="attractions.html">Tourist Attractions</a></li>
        <li><a href="comment.php">Send Comment</a></li>
        <li><a href="documentation.html">Documentation</a></li>
      </ul>
    </nav>

    <main>
      <h1>Send Comment</h1>

      <form action="http://localhost/2030-project/comment.php" method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" />
          <?php the_validation_message('name'); ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" />
          <?php the_validation_message('email'); ?>
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="text" placeholder="yyyy/mm/dd" name="date" id="date" />
          <?php the_validation_message("date"); ?>
        </div>
        <div class="form-group">
          <label for="comment">Comment</label>
          <textarea
            name="comment"
            id="comment"
            cols="30"
            rows="10"
            required
          ></textarea>
        </div>

        <button type="submit">Send</button>
      </form>

      <!-- Display the results -->
      <?php
        the_results();
        the_comments();
      ?>

    </main>

    <footer>
      <p>&copy; Ahmad Ehsani 2021</p>
      <a href="#">Back to Top</a>
    </footer>

    <nav></nav>
  </body>
</html>
