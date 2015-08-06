<?php
    $errors = $user->errors;
    // error_reporting(E_ALL & ~E_NOTICE);
?>

     <div class="row">
        <div class="col-xs-12">

          <h1 class="text-center">sosediNZ</h1>
        </div>
      </div>
<!--==================================== LOGIN FORM =======================================-->
      <div class="row">
        <div class="container">
          <div class="col-sm-4 col-sm-offset-4">
            <form method="POST" action="./?page=auth.attempt" class="form-horizontal">

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

          </div>
        </div> <!-- /Container -->
      </div> <!-- /Row -->

<!-- ============================================================================================= -->

      <div class="row">
        <div class="container">
          <div class="col-sm-6 col-sm-offset-3">
            <p>Sosedi (sa-sé-dee) means “neighbours” in Russian and sosediNZ aims to bring together neighbours from all walks of life. It’s a blogging network that connects Russian New Zealanders, their friends, family and anyone else who wants to learn more about the Russian culture or life in New Zealand.</p>
          </div>
        </div> <!-- /Container -->
      </div> <!-- /Row -->

      <div class="row">
        <div class="container">
          <div class="col-sm-4">
            <p class="lead text-center">Blog</p>
            <p>Publish your own blog posts about your experiences in New Zealand and connect with other Russians.</p>
          </div>

          <div class="col-sm-4">
            <p class="lead text-center">Comment</p>
            <p>Share your thoughts and discuss other people’s posts.</p>
          </div>

          <div class="col-sm-4">
            <p class="lead text-center">Ask</p>
            <p>Ask questions about Russian culture and find out where you can connect with the community in NZ.</p>
          </div>
        </div> <!-- /Container -->
      </div> <!-- /Row -->
