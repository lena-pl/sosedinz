<?php
    $errors = $user->errors;
?>
<div class="post">
  <div class="container" id="form-edit">
  
    <form method="POST" action="./?page=account.update" class="form-horizontal">
      <h2 class="text-center">Edit Account</h2>
      <input type="hidden" name="id" value="<?= $user->id ?>">

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

<!--             <div class="form-group form-group-lg<?php if ($errors['password']): ?> has-error <?php endif; ?>">
        <label for="password" class="col-sm-4 col-md-2 control-label">Password</label>
        <div class="col-sm-8 col-md-10">
          <input id="password" class="form-control input-lg" name="password" type="password">
          <div class="help-block"><?= $errors['password']; ?></div>
        </div>
      </div>

      <div class="form-group form-group-lg<?php if ($errors['password2']): ?> has-error <?php endif; ?>">
        <label for="password2" class="col-sm-4 col-md-2 control-label">Confirm Password</label>
        <div class="col-sm-8 col-md-10">
          <input id="password2" class="form-control input-lg" name="password2" type="password">
          <div class="help-block"><?= $errors['password2']; ?></div>
        </div>
      </div> -->

<!--       <div class="form-group form-group-lg<?php if ($errors['avatar']): ?> has-error <?php endif; ?>">
        <label for="avatar" class="col-sm-4 col-md-2 control-label">Avatar</label>
        <div class="col-sm-5 col-md-7">
          <input id="avatar" class="form-control input-lg" name="avatar"
            type="file">
          <div class="help-block"><?= $errors['avatar']; ?></div>
        </div>
        <?php if($user->avatar != ""): ?>
          <div class="col-sm-1 col-md-1">
            <img src="./images/avatars/100h/<?= $user->avatar ?>" alt="">
          </div>
          <div class="col-sm-2 col-md-2">
            <div class="checkbox">
              <label><input type="checkbox" name="remove-image" value="TRUE"> Remove Avatar</label>
            </div>
          </div>
        <?php else: ?>
          <div class="col-sm-3 col-md-3">
            <p><small>no feature image found</small></p>
          </div>
        <?php endif; ?>
      </div> -->


<!--       <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
          <button class="btn btn-comment">
            <span class="glyphicon glyphicon-ok"></span> Edit Acount
          </button>
        </div>
      </div> -->

    </form>

    <form method="POST" action="./?page=account.destroy" class="form-horizontal">
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
          <input type="hidden" name="id" value="<?= $user->id ?>">
          <button class="btn btn-comment">
            <span class="glyphicon glyphicon-trash"></span> Delete Account
          </button>
        </div>
      </div>
    </form>

  </div> <!-- /.container -->
</div> <!-- /.post -->
