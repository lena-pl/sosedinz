     <div class="row">
        <div class="col-xs-12">

        <ol class="breadcrumb">
          <li><a href="./">Home</a></li>
          <li class="active">Not Found</li>
        </ol>
      </div>
    </div>

    <div class="jumbotron">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h1>Error 500</h1>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-12 text-center">
          <p class="lead">Whoops, something went wrong. Please try again soon.</p>
          
          <div class="text-left">
          <?php if (DEV_ENVIRONMENT): ?>
              <div class="alert alert-danger" role="alert">
                <h2>Error: <?= get_class($e) ?></h2>
                <h3><?= $e->getMessage() ?></h3>
                <p>File: <?= $e->getFile() ?> Line <?= $e->getLine() ?></p>

                <?php foreach($e->getTrace() as $level => $trace): ?>
                  <pre>#<?= $level ?> <?php print_r($trace); ?></pre>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </div>