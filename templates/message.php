<?php
$this->layout('master', ['title' => 'Message']);
?>
<div class="container">
  <div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
          <h2 class="text-center">Send Message</h2>
        <?php
        if (!$message->valid && $message->submitted) {
          echo '<div class="alert alert-warning">';
          foreach ($message->get_notices() as $notice) {
            echo "<strong>Alert</strong> $notice<br>";
          }
          echo '</div>';
        } elseif (isset($notice)) {
          echo '<div class="alert alert-success">';
          echo "<strong>$notice[0]</strong> $notice[1]";
          echo '</div>';
        }
        ?>
        </div>
      </div>
      <form role="form" class="form-horizontal" action="/message" method="post">
        <div class="form-group">
          <label class="control-label col-sm-2" for="name">Name</label>
          <div class="col-sm-10">
            <input type="text"
                   class="form-control"
                   id="name" name="name"
                   placeholder="Enter your name"
                   value="<?=$message->get('name')?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email</label>
          <div class="col-sm-10">
            <input type="email"
                   class="form-control"
                   id="email" name="email"
                   placeholder="Enter your email"
                   value="<?=$message->get('email')?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="subject">Subject</label>
          <div class="col-sm-10">
            <input type="text"
                   class="form-control"
                   id="subject" name="subject"
                   placeholder="Enter a subject"
                   value="<?=$message->get('subject')?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="text">Message</label>
          <div class="col-sm-10">
            <textarea rows="12"
                      class="form-control"
                      id="text" name="text"><?=$message->get('text')?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10"
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-block">
                Send
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
</div>
