<?php

namespace jhooky;

require('Model.class.php');

class Message extends Model
{
  private $notices = [];

  public $valid = true;

  public $submitted = false;
  
  public function __construct($data) {
    $allowable = ['email', 'subject', 'text'];

    parent::__construct($allowable, $data);
    
    $this->validate();
  }

  public function get_notices() {
    return $this->notices;
  }
  
  private function validate() {
    $this->map(function ($property, $value) {
      switch ($property) {
        case 'email':
          if (!$this->email_valid_p($value)) {
            $this->valid = false;
            $this->notices[] = 'please enter a valid email.';
          }
          break;
        case 'text':
          if (strlen($value) <= 2) {
            $this->valid = false;
            $this->notices[] = 'please enter a message';
          }
          break;
        default:
          break;
      }
    });
  }

  private function email_valid_p($data) {
    return filter_var($data, FILTER_VALIDATE_EMAIL);
  }

}
