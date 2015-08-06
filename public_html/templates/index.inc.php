<?php
    $errors = $user->errors;
    // error_reporting(E_ALL & ~E_NOTICE);
?>
     <div class="row">
        <div class="col-xs-12">

        </div>
      </div>

      <div id="bg">

<!-- ======================================================================================= -->
              <!-- HOME NAV -->
<!-- ======================================================================================= -->

      <div class="int-nav">
        <div class="container">
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
            <button class="btn btn-default">
              <a href="./?page=register">Register</a>
            </button>
          </div>
        </div>
      </div>

<!--==================================== LOGIN FORM =======================================-->

  <div id="search-container">
    <div id="search-bg"></div>
    <div id="search">
      <form method="POST" action="./?page=auth.attempt" class="form-horizontal login-form">
        <h1 class="text-center"><img src="./images/sosedinz-logo.png" alt="sosediNZ" class="img-responsive"></h1>

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
              <button class="btn btn-block btn-success">
                <span class="glyphicon glyphicon-ok"></span> Log in
              </button>
            </div>
          </div>
        </form>
      <div class="credit text-center">
        Hotel Ukraina - Radisson Royal Hotel, Moscow
      </div>
    </div>
  </div>


</div>

<!-- ============================================================================================= -->


    <div id="features">
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
    </div>
