<?php
    $errors = $user->errors;
    // error_reporting(E_ALL & ~E_NOTICE);
?>

<div id="login">

<!--==================================== HOME NAV =======================================-->

  <div class="ext-nav">
    <div class="container">

      <div class="col-sm-3">
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
      </div> <!-- /col-sm-3 -->

      <div class="col-xs-12 col-sm-2 pull-right">
        <a href="./?page=register">
          <button class="btn btn-nav btn-block">
            Register
          </button>
        </a>
      </div>

    </div> <!-- /container -->
  </div> <!-- /int-nav -->

<!--==================================== LOGIN FORM =======================================-->


    <div class="container">
      <article class='glass up'>
        <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
          <h1 class="text-center"><img src="./images/sosedinz-logo.png" alt="sosediNZ" class="img-responsive"></h1>
          <form method="POST" action="./?page=auth.attempt" class="form-horizontal login-form">

            <?php if ($error): ?>
              <div class="alert alert-warning" role="alert"><strong>Warning:</strong> No user with that email and password combination was found. Check spelling/capitalisation and try again.</div>
            <?php endif; ?>

            <div class="form-group form-group-lg<?php if ($errors['email']): ?> has-error <?php endif; ?>">
              <div>
                <input id="email" class="form-control input-lg" name="email"
                  placeholder="Email Address"
                  value="<?= $user->email; ?>">
                <div class="help-block"><?= $errors['email']; ?></div>
              </div>
            </div>

            <div class="form-group form-group-lg<?php if ($errors['password']): ?> has-error <?php endif; ?>">
              <div>
                <input id="password" class="form-control input-lg" name="password" type="password" placeholder="Password">
                <div class="help-block"><?= $errors['password']; ?></div>
              </div>
            </div>


            <div class="form-group">
              <div>
                <button class="btn btn-block btn-login">
                  Log in
                </button>
              </div>
            </div>

            <p class="text-center password-prompt"><a href="./?page=contact">Forgot password?</a></p>

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

<!-- ============================================================================================= -->


<div id="features">

  <div class="arrow visible-md-block visible-lg-block">
    <img src="./images/arrow-down.png" alt="Arrow down" class="img-responsive">
  </div>

  <div class="row">
    <div class="container">
      <div class="col-sm-6 col-sm-offset-3">
        <h3 class="text-center">what is sosediNZ?</h3>
        <p class="hook">Sosedi (sa-sé-dee) means “neighbours” in Russian and sosediNZ aims to bring together neighbours from all walks of life. It’s a blogging network that connects Russian New Zealanders, their friends, family and anyone else who wants to learn more about the Russian culture or life in New Zealand.</p>
      </div>
    </div> <!-- /Container -->
  </div> <!-- /Row -->

  <div class="row">
    <div class="container">
      <div class="col-sm-4">
        <p class="text-center"><img src="./images/blog-icon.png" alt="Blog Icon"></p>
        <p class="lead text-center">Blog</p>
        <p>Publish your own blog posts about your experiences in New Zealand and connect with other Russians.</p>
      </div>

      <div class="col-sm-4">
        <p class="text-center"><img src="./images/comment-icon.png" alt="Comment Icon"></p>
        <p class="lead text-center">Comment</p>
        <p>Share your thoughts and discuss other people’s posts.</p>
      </div>

      <div class="col-sm-4">
        <p class="text-center"><img src="./images/ask-icon.png" alt="Ask Icon"></p>
        <p class="lead text-center">Ask</p>
        <p>Ask questions about Russian culture and find out where you can connect with the community in NZ.</p>
      </div>
    </div> <!-- /Container -->
  </div> <!-- /Row -->

</div> <!-- /features -->
