<?php

namespace jhooky;

require 'Model.class.php';

class Message extends Model
{
  private $notices = [];

  public $valid = true;

  public $submitted = false;
  
  public function __construct($data) {
    $allowable = ['email', 'subject', 'text', 'name'];

    parent::__construct($allowable, $data);
    
    $this->validate();
  }

  public function get_notices() {
    return $this->notices;
  }

  public function email() {
    $subject = '';
    $headers = '';
    $message = '';
    
    if ($this->get('subject') != NULL) {
      $subject = $this->get('subject');
    } else {
      $subject = 'Response Request';
    }
    $headers .= "From: Hooks Crane Messages <webmaster@hookhook.co>\r\n";
    if ($this->get('name') != NULL) {
      $message .= 'By: ' . $this->get('name') . ' <' . $this->get('email') . ">\r\n\r\n";
    } else {
      $message .= "By: anonymous\r\n\r\n";
    }
    $message .= "Message:\r\n\r\n" . wordwrap($this->get('text'));
    
    mail('john@hookscrane.com', $subject, $message, $headers);
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

?>
