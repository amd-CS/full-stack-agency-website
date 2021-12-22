<?php
// Global result of form validation
$valid = false;

// Global array of validation messages. For valid fields, message is ""
$val_messages = Array();

// Output the results if all fields are valid.
function the_results()
{
  global $valid;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if ($valid) {
        echo "<div>";
        echo "<p>Your name is: " . $_POST['name'] . "</p>";
        echo "<p>Your email address is: " . $_POST['email'] . "</p>";
        echo "<p>The entered date is: " . $_POST['date'] . "</p>";
        echo "<p>Your comment is: " . $_POST['comment'] . "</p>";
        echo "</div";
    }
  }
}

// Check each field to make sure submitted data is valid. 
// If no check boxes are checked, isset() will return false
function validate()
{
    global $valid;
    global $val_messages;

    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
      // name should be at least three characters long
      $patternName = '#.{3,}#';
      $validName = preg_match($patternName, $_POST['name']) == true;
      $validName ? $val_messages["name"] = "" : $val_messages["name"] = "Name is too short";

      // email: '#^(.+)@([^\.].*)\.([a-z]{2,})$#'
      $patternEmail = '#^(.+)@([^\.]+)\.([a-z]{2,})$#';
      $validEmail = preg_match($patternEmail, $_POST['email']) == true;
      $validEmail ? $val_messages["email"] = "" : $val_messages["email"] = "Email is not correct format";

      // date: '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#'
      $patternDate = '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#';
      $validDate = preg_match($patternDate, $_POST['date']) == true;
      $validDate ? $val_messages["date"] = "" : $val_messages["date"] = "Please enter a valid date in format yyyy/mm/dd";

      if ($validEmail && $validDate && $validName) {$valid = true;}
    }
}

// Display error message if field not valid. Displays nothing if the field is valid.
function the_validation_message($type) {

  global $val_messages;

  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
      echo "<p>$val_messages[$type]</p>";
  }
}
