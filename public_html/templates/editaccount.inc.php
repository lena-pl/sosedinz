<?php
    $errors = $user->errors;
?>
<div class="post">
  <div class="container" id="form-edit">
  
    <form method="POST" action="./?page=account.destroy" class="form-horizontal">
      <h2 class="text-center">Edit Account</h2>
      <input type="hidden" name="id" value="<?= static::$auth->user()->id ?>">

      <div class="form-group form-group-lg<?php if ($errors['email']): ?> has-error <?php endif; ?>">
        <label for="email" class="col-sm-4 col-md-2 control-label">Email Address</label>
        <div class="col-sm-8 col-md-10">
          <input id="email" class="form-control input-lg" name="email"
            placeholder="your_email"
            value="<?= $user->email; ?>">
          <div class="help-block"><?= $errors['email']; ?></div>
        </div>
      </div>

      <div class="form-group form-group-lg<?php if ($errors['username']): ?> has-error <?php endif; ?>">
        <label for="username" class="col-sm-4 col-md-2 control-label">Username</label>
        <div class="col-sm-8 col-md-10">
          <input id="username" class="form-control input-lg" name="username"
            placeholder="your_username"
            value="<?= $user->username; ?>">
          <div class="help-block"><?= $errors['username']; ?></div>
        </div>
      </div>

      <div class="form-group form-group-lg<?php if ($errors['bio']): ?> has-error <?php endif; ?>">
        <label for="bio" class="col-sm-4 col-md-2 control-label">Bio</label>
        <div class="col-sm-8 col-md-10">
          <input id="bio" class="form-control input-lg" name="bio"
            placeholder="A little bit about me..."
            value="<?= $user->bio; ?>">
          <div class="help-block"><?= $errors['bio']; ?></div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
          <input type="hidden" name="id" value="<?= $user->id ?>">
          <button class="btn btn-comment">
            <span class="glyphicon glyphicon-trash"></span> Delete Account
          </button>
        </div>
      </div>

  </div> <!-- /.container -->
</div> <!-- /.post -->
