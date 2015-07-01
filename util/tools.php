<?php

namespace jhooky\tools;

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validate_email($data) {
  return filter_var($data, FILTER_VALIDATE_EMAIL);
}

function validate_phone($data) {
  $regex = "/^\(?\d{3}\)?[ \-.]?\d{3}[ \-.]?\d{4}$/";
  return preg_match($regex, $data);
}
?>
