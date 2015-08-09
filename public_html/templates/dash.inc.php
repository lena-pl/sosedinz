          <div class="user-info text-center">
            <div class="container">
              <div>
                <img src="<?= $user->gravatar(48, 'identicon') ?>" alt="">
              </div>

              <div>
                <h4 class="media-heading"><?= $user->username; ?></h4>
                <p class="lead"><?= $user->bio; ?></p>
              </div>
            </div><!-- /.container -->
          </div><!-- /.user-info -->

          <div class="container">
            <h3 class="text-center">
              <?php if (static::$auth->user()->id === $user->id): ?>
                My posts
              <?php else: ?>
                <?= $user->username ?>'s posts
              <?php endif; ?>
            </h3>

              <?php if (count($posts) > 0): ?>

                <?php foreach ($posts as $post): ?>
                  <div class="col-md-4">
                    <div class="post-preview">
                      <h4 class="text-center"><a href="./?page=post&amp;id=<?= $post->id ?>">
                      <?= $post->title ?></a></h4>
                      <div><?= $post->content ?></div>
                    </div>
                  </div>
                <?php endforeach; ?>

              <?php else: ?>

                <p>No posts found. Sorry.</p>

              <?php endif; ?>

            <div class="col-sm-12">
              <?php $this->paginate("./?page=posts", $p, $recordCount, $pageSize, 5); ?>
            </div>
          </div><!-- /.container -->
