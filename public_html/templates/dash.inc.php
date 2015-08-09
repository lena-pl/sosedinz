<div class="user-info text-center">
  <div class="container">

    <div>
      <img src="<?= $user->gravatar(120, 'identicon') ?>" alt="Gravatar" class="dash-photo">
    </div>

    <div>
      <h4 class="media-heading"><?= $user->username; ?></h4>
      <p class="lead"><?= $user->bio; ?></p>
    </div>
  </div><!-- /.container -->
</div><!-- /.user-info -->

<div class="container">
  <h3 class="text-center dash-heading">
    <?php if (static::$auth->user()->id === $user->id): ?>
      My posts
    <?php else: ?>
      <?= $user->username ?>'s posts
    <?php endif; ?>
  </h3>

    <?php if (count($posts) > 0): ?>
      <?php foreach ($posts as $post ): ?>
        <?= $post->loadTags() ?>
        <div class="col-md-6 col-lg-4">

          <div class="post-preview">
            <h4 class="text-center post-title"><a href="./?page=post&amp;id=<?= $post->id ?>">
            <?= $post->title ?></a></h4>
            <div><?= substr("$post->content", 0, 388) ?><a href="./?page=post&amp;id=<?= $post->id ?>"><span>…</span></a></div>

            <div class="extra">
              <div class="tags"><?= $post->tags ?></div>

              <div>
                <a href="./?page=post&amp;id=<?= $post->id ?>#comments"><?= count($post->comments()) ?> 
                  <?php if (count($post->comments()) === 1): ?> 
                    comment
                  <?php else: ?>
                    comments
                  <?php endif; ?>
                </a>
              </div>
            </div> <!-- /.extra -->
           
          </div> <!-- /.post-preview -->

        </div> <!-- /.col-md-4 -->
      <?php endforeach; ?>
    <?php else: ?>
      <p>No posts found. Sorry.</p>
    <?php endif; ?>


    <div class="col-xs-12 text-center pagination">
      <?php $this->paginate("./?page=dash&id=" . $user->id, $p, $recordCount, $pageSize); ?>
    </div>

</div><!-- /.container -->
