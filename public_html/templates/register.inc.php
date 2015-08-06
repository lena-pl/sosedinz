<?php
    $errors = $user->errors;
?>

<!-- ======================================================================================= -->
              <!-- HOME NAV -->
<!-- ======================================================================================= -->

      <div class="row">
        <div class="container int-nav">
          <div class="col-sm-2"><a href="./"><img src="./images/sosedinz-logo.png" alt="sosediNZ" class="img-responsive"></a></div>
          <div class="col-sm-3 col-md-3">
            <form method="GET" action="./" class="navbar-form navbar-right" role="search">
              <div class="form-group input-group">
                <input type="hidden" name="page" value="search">
                <input name="q" type="search" class="form-control" placeholder="Search">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" aria-label="Search">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </button>
                  </span>
              </div>
            </form>
          </div>

          <div class="col-sm-2 pull-right">
            <a href="./?page=register" class="active">Register</a>
          </div>
        </div>
      </div>

<!-- ======================================================================================= -->

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
