<!-- ======================================================================================= -->
              <!-- HOME NAV -->
<!-- ======================================================================================= -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand visible-sm-inline-block visible-xs-inline-block" href="./">sosediNZ</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
              </ul>
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
              <ul class="nav navbar-nav navbar-right">
                <?php if (! static::$auth->check()): ?>
                  <li <?php if ($page === "auth.register"): ?> class="active" <?php endif; ?>><a href="./?page=register">Register</a></li>
                <?php else: ?>
                  <li><a href="#"><?= static::$auth->user()->username; ?></a></li>
                  <li><a href="./?page=logout">Logout</a></li>
                <?php endif; ?>
              </ul>
            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
        </div>
      </nav>