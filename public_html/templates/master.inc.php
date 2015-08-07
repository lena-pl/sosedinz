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

  <body>

      <?php $this->content (); ?>

  <footer class="text-center">
    <div class="col-sm-3">
      © <?php echo date("Y") ?> sosediNZ
    </div>
    <div class="col-sm-3">
      Community Rules
    </div>
    <div class="col-sm-3">
      Site Map
    </div>
    <div class="col-sm-3">
      Contact Us
    </div>
  </footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>

</html>
