<?php

namespace jhooky;

class Form
{
  private $notices = [];
  private $elements = [];
  
  public function __construct($fields) {
    foreach ($fields as $field => $value) {
      $this->elements[$field] = ['data' => $value];
    }
    $this->validate();
  }

  public function get($name) {
    if ($name == 'notices') {
      return $this->notices;
    } elseif (isset($this->elements[$name])) {
      return $this->elements[$name]['data'];
    } else {
      return NULL;
    }
  }
  
  public function submitted_p() {
    $result = false;
    foreach ($this->elements as $key => $value) {
      if ($value['data'] != NULL) {
        $result = true;
      }
    }
    return $result;
  }
  
  public function valid_p() {
    $result = true;
    foreach ($this->elements as $key => $value) {
      if ($key != 'email' && $key != 'phone' && !$value['valid'] ) {
        $result = false;
      }
    }
    // test phone and email seperately, only need one or the other for form to be valid;
    if (isset($this->elements['email']) && isset($this->elements['phone'])) {
      if (!$this->elements['email']['valid'] && !$this->elements['phone']['valid']) {
        $result = false;
      }
    } elseif (isset($this->elements['email'])) {
      if (!$this->elements['email']['valid']) {
        $result = false;
      }
    } elseif (isset($this->elements['phone'])) {
      if (!$this->elements['email']['valid']) {
        $result = false;
      }
    }
    return $result;
  }

  public function email($to) {
    $subject = '';
    $headers = '';
    $message = '';

    foreach ($this->elements as $key => $value) {
      if ($key != 'message') {
        switch ($key) {
          case 'subject':
            $subject = $value['data'];
            break;
          case 'email':
            $headers = 'From: ' . $value['data'] . "\r\n";
            break;
          default:
            $message .= ucfirst($key) . ' : ' . $value['data'] . "\r\n";
        }
      }
    }

    if (empty($subject)) {
      $subject = 'Email from Hooks Crane';
    }

    $message .= wordwrap("\r\n" . $this->elements['message']['data']);
    
    mail($to, $subject, $message, $headers);
  }

  private function process_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  private function validate() {
    foreach ($this->elements as $key => $value) {
      switch ($key) {
        case 'email':
          if ($this->email_valid_p($value['data'])) {
            $this->elements[$key]['valid'] = true;
          } else {
            $this->elements[$key]['valid'] = false;
            $this->notices[] = 'please enter a valid email.';
          }
          break;
        case 'phone':
          if ($this->phone_valid_p($value['data'])) {
            $this->elements[$key]['valid'] = true;
          } else {
            $this->elements[$key]['valid'] = false;
            $this->notices[] = 'please enter a valid phone number.';
          }
          break;
        case 'date':
          if ($this->date_valid_p($value['data'])) {
            $this->elements[$key]['valid'] = true;
          } else {
            $this->elements[$key]['valid'] = false;
            $this->notices[] = 'please enter a valid date. <i>YYYY-MM-DD or MM-DD-YYYY</i>';
          }
          break;
        case 'message':
          if (strlen($value['data']) >= 1) {
            $this->elements[$key]['valid'] = true;
          } else {
            $this->elements[$key]['valid'] = false;
            $this->notices[] = 'please enter a message';
          }
          break;
        default:
          $this->elements[$key]['valid'] = true;
      }
    }
  }

  private function email_valid_p($data) {
    return filter_var($data, FILTER_VALIDATE_EMAIL);
  }

  private function phone_valid_p($data) {
    $regex = "/^\(?\d{3}\)?[ \-.]?\d{3}[ \-.]?\d{4}$/";
    return preg_match($regex, $data);
  }
  private function date_valid_p($data) {
    // accepts 2015[-/\ ]06[-/\ ]18 or 06[-/\ ]18[-/\ ]2015
    $regex = "/^(\d{2}[-\/\\ ]\d{2}[-\/\\ ]\d{4}|\d{4}[-\/\\ ]\d{2}[-\/\\ ]\d{2})$/";
    return preg_match($regex, $data);
  }
}

?>
