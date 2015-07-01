<?php

namespace jhooky;

class Model
{
  private $properties = [];
  
  public function __construct($keys, $data) {
    // create the whitelist of acceptable keys
    foreach ($keys as $key) {
      $this->properties[$key] = isset($data[$key]) ?
                                $this->clean($data[$key]) :
                                NULL;
    }
  }

  public function set($property, $value) {
    if (isset($this->properties[$property])) {
      $this->properties[$property] = $this->clean($value);
    } else {
      return NULL;
    }
  }

  public function get($property) {
    if (isset($this->properties[$property])) {
      return $this->properties[$property];
    } else {
      return NULL;
    }
  }

  public function map($cb) {
    $result = [];
    foreach ($this->properties as $property => $value) {
      $result = $cb($property, $value);
    }
    return $result;
  }

  private function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

}

?>
