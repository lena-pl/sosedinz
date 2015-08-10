<div class="user-info text-center">
  <div class="container">

    <div>
      <h1 class="text-center">Search results for: "<?= $q ?>"</h1>
    </div>

  </div><!-- /.container -->
</div><!-- /.user-info -->

  <div class="container search-results">

    <?php if (count($posts) > 0): ?>
      <?php foreach ($posts as $post ): ?>
        <?= $post->loadTags() ?>
        <div class="col-md-6 col-lg-4">

          <div class="post-preview">
            <h4 class="text-center post-title"><a href="./?page=post&amp;id=<?= $post->id ?>">
            <?= $post->title ?></a></h4>
            <div><?= substr("$post->content", 0, 388) ?><a href="./?page=post&amp;id=<?= $post->id ?>"><span>…</span></a></div>

            <div class="extra">
              <div class="tags">
                <?php if ($post->tags == ""): ?> 
                  no tags to display
                <?php else: ?>
                  <?= $post->tags ?>
                <?php endif; ?>
              </div>

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
      <p>That search didn't return any posts. Try again!</p>
    <?php endif; ?>

  </div> <!-- /.container -->