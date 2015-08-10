<div class="post">
  <div class="container">

    <ol class="breadcrumb">
      <li><a href="./">Home</a></li>
      <li class="active">Not Found</li>
    </ol>

    <div class="jumbotron clearfix">

      <div class="row">
        <div class="col-xs-12 text-center">
          <h1>Error 500</h1>
        </div> <!-- ./col-xs-12 -->
      </div> <!-- /.row -->

      <div class="col-sm-12 ">

        <p class="lead text-center">Whoops, something went wrong. Please try again soon.</p>
        
        <div>

          <?php if (DEV_ENVIRONMENT): ?>
            <div class="alert alert-danger" role="alert">
              <h2>Error: <?= get_class($e) ?></h2>
              <h3><?= $e->getMessage() ?></h3>
              <p>File: <?= $e->getFile() ?> Line <?= $e->getLine() ?></p>

              <?php foreach($e->getTrace() as $level => $trace): ?>
                <pre>#<?= $level ?> <?php print_r($trace); ?></pre>
              <?php endforeach; ?>
            </div> <!-- ./alert -->
          <?php endif; ?>

        </div> <!-- /.text-left -->

      </div> <!-- /.col-sm-12 text-center -->

    </div> <!-- /jumbotron -->
  </div> <!-- /.container -->
</div> <!-- /.post-preview -->