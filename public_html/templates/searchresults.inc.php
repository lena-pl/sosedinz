<div class="row">
  <div class="col-xs-12">

    <h1>Search Results:</h1>

    <?php if (count($posts) > 0): ?>

      <ol>
        <?php foreach($posts as $post): ?>
          <li>
            <h3><a href="./?page=post&amp;id=<?= $post->id ?>">
              <?= $post->title; ?>
            </a></h3>
            <p><?= $post->content; ?></p>
            <ul class="list-inline">
            <?php foreach($post->getTags() as $tag): ?><!--
              --><li><span class="label label-default"><?= $tag->tag ?></span></li><!--
            --><?php endforeach; ?>
            </ul>
          </li>
        <?php endforeach; ?>
      </ol>

    <?php else: ?>

      <p>That search didn't return any posts. Try again!</p>

    <?php endif; ?>

    <?php $this->paginate("./?page=search", $p, $recordCount, $pageSize, 5); ?>

  </div>
</div>