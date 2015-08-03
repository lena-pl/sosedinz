     <div class="row">
        <div class="col-xs-12">
          <h1>My Posts</h1>

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
