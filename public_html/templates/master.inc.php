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

  </head>

  <body>

    <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">sosediNZ</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li <?php if ($page === "index"): ?> class="active" <?php endif ?> ><a href="./">Home</a></li>
              <li <?php if ($page === "browse"): ?> class="active" <?php endif ?> ><a href="./?page=browse">Search</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php if (! static::$auth->check()): ?>
                <li <?php if ($page === "auth.register"): ?> class="active" <?php endif; ?>><a href="./?page=register">Register</a></li>
                <li <?php if ($page === "auth.login"): ?> class="active" <?php endif; ?>><a href="./?page=login">Login</a></li>
              <?php else: ?>
                <li><a href="#"><?= static::$auth->user()->username; ?></a></li>
                <li><a href="./?page=logout">Logout</a></li>
              <?php endif; ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <?php $this->content (); ?>

      <footer>
        <hr>
        <p>© <?php echo date("Y") ?> sosediNZ</p>
      </footer>

    </div><!-- /.container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>

</html>
