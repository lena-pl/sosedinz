<?php
  $errors = $contactform['errors'];
?>

<div class="post">
  <div class="container">

      <form id="contact" action="./?page=send.message" method="POST" class="form-horizontal contact-form">

        <h2 class="text-center">Contact Us</h2>

            <div class="form-group <?php if ($errors['title']): ?>has-error<?php endif;?>">
                <label for="subject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-8">
                    <input id="subject" class="form-control" name="title" placeholder="eg: Forgot my password" value="<?php echo $contactform['title']; ?>">
                    <div class="help-block"><?php echo $errors['title']; ?></div>
                </div>
            </div>

            <div class="form-group <?php if ($errors['email']): ?>has-error<?php endif;?>">
                <label for="email" class="col-sm-2 control-label">Email Address</label>
              <div class="col-sm-8">
                  <input id="email" class="form-control" name="email" type="email" placeholder="your-email@example.com" value="<?php echo $contactform['email']; ?>">
                  <div class="help-block"><?php echo $errors['email']; ?></div>
              </div>
            </div>

            <div class="form-group <?php if ($errors['message']): ?>has-error<?php endif;?>">
                <label for="message" class="col-sm-2 control-label">Your Message</label>
              <div class="col-sm-8">
                  <textarea id="mesage" class="form-control" name="message" placeholder="Write your message here..." value="<?php echo $contactform['message']; ?>" rows="5"></textarea>
                  <div class="help-block"><?php echo $errors['message']; ?></div>
              </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                <button class="btn btn-block btn-comment">Send Message</button>
            </div>
        </div>

      </form>
    
  </div> <!-- /.container -->
</div> <!-- /.post-preview -->
