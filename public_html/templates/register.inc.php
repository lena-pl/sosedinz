<?php
    $errors = $user->errors;
?>
      <div class="row">
        <div class="col-xs-12">
          <form method="POST" action="./?page=auth.store" class="form-horizontal">
            <h1>Register New User</h1>

            <div class="form-group form-group-lg<?php if ($errors['username']): ?> has-error <?php endif; ?>">
              <label for="username" class="col-sm-4 col-md-2 control-label">Username</label>
              <div class="col-sm-8 col-md-10">
                <input id="username" class="form-control input-lg" name="username"
                  placeholder="your_username"
                  value="<?= $user->username; ?>">
                <div class="help-block"><?= $errors['username']; ?></div>
              </div>
            </div>

            <div class="form-group form-group-lg<?php if ($errors['email']): ?> has-error <?php endif; ?>">
              <label for="email" class="col-sm-4 col-md-2 control-label">Email Address</label>
              <div class="col-sm-8 col-md-10">
                <input id="email" class="form-control input-lg" name="email"
                  placeholder="you@example.com"
                  value="<?= $user->email; ?>">
                <div class="help-block"><?= $errors['email']; ?></div>
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

            <div class="form-group form-group-lg<?php if ($errors['password']): ?> has-error <?php endif; ?>">
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
            </div>


            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
                <button class="btn btn-success">
                  <span class="glyphicon glyphicon-ok"></span> Register
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
