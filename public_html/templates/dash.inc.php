     <div class="row">
        <div class="col-xs-12">

          <div>
            <img src="<?= $user->gravatar(48, 'identicon') ?>" alt="">
          </div>

          <h4 class="media-heading"><?= $user->username; ?></h4>
          <p class="lead"><?= $user->bio; ?></p>

          <h3>My Posts</h3>

          <ul>

            <?php if (count($posts) > 0): ?>

              <?php foreach ($posts as $post): ?>
                <li><a href="./?page=post&amp;id=<?= $post->id ?>">
                <?= $post->title ?></a></li>
              <?php endforeach; ?>

            <?php else: ?>

              <p>No posts found. Sorry.</p>

            <?php endif; ?>
          </ul>

          <?php $this->paginate("./?page=posts", $p, $recordCount, $pageSize, 5); ?>
      </div>
    </div>
