<?php
// error_reporting(E_ALL & ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>sosediNZ <?php if ($page_title) echo "—"; ?> <?= $page_title ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Main -->
    <link href="css/main.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

<!-- ======================================================================================= -->
              <!-- NEW NAV -->
<!-- ======================================================================================= -->
      <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./?page=dash">sosediNZ</a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            </li>
          </ul>
          <div class="col-sm-3 col-md-3">
              <form class="navbar-form" role="search">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" name="search">
                  <div class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
              </div>
              </form>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./?page=dash"><?= static::$auth->user()->username; ?></a></li>
            <li><a href="./?page=post.create">New Post</a></li>
            <li><a href="./?page=logout">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <?php $this->content (); ?>

      <footer>
        <p>© <?php echo date("Y") ?> sosediNZ</p>
      </footer>

    </div><!-- /.container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- Taggle JS library -->
<script src="js/taggle-ie9.min.js"></script>
<!-- Our hand-written JS -->
<script src="js/main.js"></script>
</body>

</html>
