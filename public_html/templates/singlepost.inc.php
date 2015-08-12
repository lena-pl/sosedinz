     <?php
       $errors = $newcomment->errors;
     ?>

<div class="user-info text-center">
  <div class="container">

    <a href="./?page=dash&amp;id=<?= $post->user_id ?>">
      <div>
        <img src="<?= $user->gravatar(120, 'identicon') ?>" alt="Gravatar" class="dash-photo">
        <h4 class="media-heading username"><?= $user->username; ?></h4>
      </div>
    </a>

    <div>
      <div class="col-sm-offset-2 col-sm-8"><p class="lead"><?= $user->bio; ?></p></div>
    </div>
  </div><!-- /.container -->
</div><!-- /.user-info -->

<div class="post">
  <div class="container">

	<h2 class="text-center"><?= htmlentities($post->title) ?></h2>

  <div class="clearfix">
    <div class="col-sm-offset-1 col-sm-10">
      <?php if($post->feature_img != ""): ?>
        <p class="text-center"><img src="./images/features/300h/<?= $post->feature_img ?>" alt="" class="feature-img"></p>
      <?php endif; ?>
      <p><?= nl2br(htmlentities($post->content)); ?></p>

      <ul class="list-inline post-content">
        <?php foreach($tags as $tag): ?><!--
        --><li><span class="label label-default"><?= $tag->tag ?></span></li><!--
     --><?php endforeach; ?>
      </ul>

    <?php if (static::$auth->check()): ?>
      <?php if (static::$auth->isOwner($post->user_id)): ?>
        <p>
          <a href="./?page=post.edit&amp;id=<?= $post->id ?>" class="btn btn-comment"><span class="glyphicon glyphicon-pencil"></span> Edit post</a>
        </p>
      <?php endif; ?>
    <?php endif; ?>
    </div>
  </div>

  </div> <!-- /.container -->
</div> <!-- /.post-preview -->

<div id="comments">
  <div class="container">
    <div class="col-sm-offset-1 col-sm-10">
      <div class="comment-section">
        <?php if (count($comments) > 0): ?>
          <?php $count = 0; ?>
          <?php foreach($comments as $comment): ?>
            <?php $count += 1; ?>
            <article id="comment-<?= $comment->id ?>" class="media comment">
              <div class="media-left">
                <a class="username" href="./?page=dash&amp;id=<?= $comment->user_id ?>">
                  <img class="dash-photo" src="<?= $comment->user()->gravatar(60, 'identicon') ?>" alt="">
                </a>
              </div>
              <div class="media-body">

                <h4 class="media-heading">
                  <a class="username" href="./?page=dash&amp;id=<?= $comment->user_id ?>">
                    <?= $comment->user()->username ?>
                  </a>

                  <?php if (static::$auth->check()): ?>
                    <?php if (static::$auth->isOwner($comment->user_id)): ?>
                      | <a href="./?page=comment.edit&id=<?= $comment->id ?>" class="edit-comment username">
                        Edit Comment
                      </a>
                    <?php endif; ?>
                  <?php endif; ?>
                </h4>

                <p><?= nl2br(htmlentities($comment->comment)) ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No comments. Yet…</p>
        <?php endif; ?>
      </div>

    <p class="lead">Add a comment to '<?= $post->title ?>':</p>
      <?php if (static::$auth->check()): ?>
        <form method="POST" action="./?page=comment.create" class="form-horizontal">
          <input type="hidden" name="post_id" value="<?= $post->id ?>">

          <div class="form-group <?php if ($errors['comment']): ?> has-error <?php endif; ?>">
            <div class="col-sm-8 col-md-10">
              <textarea id="comment" class="form-control" name="comment" rows="5"><?= $newcomment->comment ?></textarea>
              <div class="help-block"><?= $errors['comment']; ?></div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-10">
              <button class="btn btn-comment">
                Post my comment
              </button>
            </div>
          </div>
        </form>
      <?php else: ?>
        <p>You need to be <a href="./?page=login">logged in</a> to add a comment.</p>
      <?php endif; ?>
    </div>

    </div>
  </div> <!-- /.container -->
</div> <!-- /.comments -->
