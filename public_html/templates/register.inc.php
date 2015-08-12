<?php
    $errors = $user->errors;
?>

<div id="login">
<!--==================================== HOME STYLE NAV =======================================-->

  <div class="ext-nav">
    <div class="container">

      <div class="col-sm-3 col-md-3">
        <form method="GET" action="./" class="navbar-form" role="search">
          <div class="form-group input-group">
            <input type="hidden" name="page" value="search">
            <input name="q" type="search" class="form-control search" placeholder="Search">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-search" aria-label="Search">
                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
              </span>
          </div>
        </form>
      </div>

      <div class="col-xs-12 col-sm-3 col-lg-2">
        <a href="./?page=browse">
          <button class="btn btn-browse btn-block">
            Browse all posts
          </button>
        </a>
      </div>

      <div class="col-xs-12 col-sm-2 pull-right">
        <a href="./">
          <button class="btn btn-nav btn-block">
          Login
          </button>
        </a>
      </div>

    </div> <!-- /container  -->
  </div> <!-- /int-nav -->

<!--==================================== REGISTRATION FORM =======================================-->

  <div class="container">
    <article class='glass up'>
      <div class="col-md-offset-3 col-md-6">

        <form method="POST" action="./?page=auth.store" class="form-horizontal login-form">
          <h1 class="text-center"><img src="./images/sosedinz-logo.png" alt="sosediNZ" class="img-responsive"></h1>

          <div class="col-sm-6">
            <div class="form-group form-group-lg<?php if ($errors['email']): ?> has-error <?php endif; ?>">
              <div>
                <input id="email" class="form-control input-lg" name="email"
                  placeholder="Email Address"
                  value="<?= $user->email; ?>">
                <div class="help-block"><?= $errors['email']; ?></div>
              </div>
            </div>

            <div class="form-group form-group-lg<?php if ($errors['username']): ?> has-error <?php endif; ?>">
              <div>
                <input id="username" class="form-control input-lg" name="username"
                  placeholder="Username"
                  value="<?= $user->username; ?>">
                <div class="help-block"><?= $errors['username']; ?></div>
              </div>
            </div>

            <div class="form-group form-group-lg<?php if ($errors['password']): ?> has-error <?php endif; ?>">
              <div>
                <input id="password" class="form-control input-lg" name="password" type="password" placeholder="Password">
                <div class="help-block"><?= $errors['password']; ?></div>
              </div>
            </div>

            <div class="form-group form-group-lg<?php if ($errors['password2']): ?> has-error <?php endif; ?>">
              <div>
                <input id="password2" class="form-control input-lg" name="password2" type="password" placeholder="Confirm Password">
                <div class="help-block"><?= $errors['password2']; ?></div>
              </div>
            </div>

          </div> <!-- /col-6 -->

          <div class="col-sm-6 bio">
            <div class="form-group <?php if ($errors['bio']): ?>has-error<?php endif;?>">
              <div>
                  <textarea id="bio" class="form-control" name="bio" placeholder="Bio (140 characters max)" value="<?= $user->bio; ?>" rows="8"></textarea>
                  <div class="help-block"><?php echo $errors['bio']; ?></div>
              </div>
            </div>
          </div> <!-- /col-6 -->

          <div class="col-sm-12">
            <div class="form-group">
              <div>
                <button class="btn btn-block btn-register">
                  Sign Up
                </button>
              </div>
            </div>
          </div> <!-- /col-12 -->

        </form>

      </div> <!-- /col-sm-4 -->
    </article>
  </div> <!-- /container -->

  <div class="hidden">
    <svg xmlns="http://www.w3.org/2000/svg"  version="1.1">
      <defs>
        <filter id="blur">
          <feGaussianBlur stdDeviation="5"/>
        </filter>
      </defs>
    </svg>
  </div>

  <div class="container">
    <p class="credit">Hotel Ukraina - Radisson Royal Hotel, Moscow</p>
  </div>

</div> <!-- /login -->
