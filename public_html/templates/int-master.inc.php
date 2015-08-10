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
    <!-- Custom Stylesheet -->
    <link href="css/main.css" rel="stylesheet">

  </head>

  <body class="footer-safe">

<!-- ======================================================================================= -->
              <!-- HOME NAV -->
<!-- ======================================================================================= -->
    <nav class="navbar navbar-default int-nav">
      <div class="container">
        <div class="container-fluid">

          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            </ul>
            <div class="col-sm-2 hidden-sm logo"><a href="./"><img src="./images/sosedinz-logo.png" alt="sosediNZ" class="img-responsive"></a></div>
            <div class="col-sm-3 col-md-3">
                <form method="GET" action="./" class="navbar-form navbar-right" role="search">
                  <div class="form-group input-group">
                    <input type="hidden" name="page" value="search">
                    <input name="q" type="search" class="form-control int-search" placeholder="Search">
                      <span class="input-group-btn">
                        <button type="submit" class="btn int-btn-search" aria-label="Search">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                      </span>
                  </div>
                </form>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <?php if (! static::$auth->check()): ?>
                <li><a href="./">Login</a></li>
                <li <?php if ($page === "auth.register"): ?> class="active" <?php endif; ?>><a href="./?page=register">Register</a></li>
              <?php else: ?>
              <li class="nav-item"><a href="./?page=post.create"><span class="glyphicon glyphicon-plus"></span> New Post</a></li>
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= static::$auth->user()->username; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="./?page=home">Dashboard</a></li>
                  <li><a href="./?page=account.edit">Edit Account</a></li>
                  <li class="divider"></li>
                  <li><a href="./?page=logout">Logout</a></li>
                </ul>
              <?php endif; ?>
            </ul>

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div> <!-- /container -->
    </nav>

    <div class="int-content">
          <?php $this->content (); ?>
    </div> <!-- /int-content -->

    <footer class="text-center">
      <div class="col-sm-3">
        © <?php echo date("Y") ?> sosediNZ
      </div>
      <div class="col-sm-3">
        <a href="./?page=community">Community Rules</a>
      </div>
      <div class="col-sm-3">
        <a href="./?page=site.map">Site Map</a>
      </div>
      <div class="col-sm-3">
        <a href="./?page=contact">Contact Us</a>
      </div>
    </footer>


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
