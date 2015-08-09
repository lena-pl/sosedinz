     <?php
       $errors = $newcomment->errors;
     ?>

     <div class="container">
      <div class="post">

			<h1><?= $post->title ?></h1>

      <article class="media">
        <div class="media-left">
          <img src="<?= $post->user()->gravatar(48, 'identicon') ?>" alt="">
        </div>
        <div class="media-body">
          <h4 class="media-heading">By: <a href="./?page=dash&amp;id=<?= $post->user_id ?>"><?= $post->user()->username ?></a></h4>
        </div>
      </article>

      <?php if($post->feature_img != ""): ?>
        <img src="./images/features/300h/<?= $post->feature_img ?>" alt="">
      <?php endif; ?>
      <p><?= $post->content ?></p>

      <ul class="list-inline">
        <?php foreach($tags as $tag): ?><!--
        --><li><span class="label label-default"><?= $tag->tag ?></span></li><!--
     --><?php endforeach; ?>
      </ul>

      <?php if (static::$auth->isOwner($post->user_id)): ?>
        <p>
          <a href="./?page=post.edit&amp;id=<?= $post->id ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Edit post</a>
        </p>
      <?php endif; ?>

      <h2 id="comments">Comments</h2>
        <?php if (count($comments) > 0): ?>
          <?php $count = 0; ?>
          <?php foreach($comments as $comment): ?>
            <?php $count += 1; ?>
            <article id="comment-<?= $comment->id ?>" class="media">
              <div class="media-left">
                <img src="<?= $comment->user()->gravatar(48, 'identicon') ?>" alt="">
              </div>
              <div class="media-body">

                <h4 class="media-heading">#<?= $count ?> <a href="./?page=dash&amp;id=<?= $comment->user_id ?>"><?= $comment->user()->username ?></a></h4>

                <?php if (static::$auth->isOwner($comment->user_id)): ?>
                  <form method="POST" action="./?page=comment.edit&id=<?= $comment->id ?>" class="form-horizontal">
                    <div class="form-group">
                      <div class="col-sm-10">
                        <input type="hidden" name="id" value="<?= $comment->id ?>">
                        <button class="btn btn-danger">
                          Edit Comment
                        </button>
                      </div>
                    </div>
                  </form>
                <?php endif; ?>

                <p><?= $comment->comment ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No comments. Yet…</p>
        <?php endif; ?>

      <h3>Add Comment to '<?= $post->title ?>'</h3>
        <?php if (static::$auth->check()): ?>
          <form method="POST" action="./?page=comment.create" class="form-horizontal">
            <input type="hidden" name="post_id" value="<?= $post->id ?>">

            <div class="form-group <?php if ($errors['comment']): ?> has-error <?php endif; ?>">
              <label for="comment" class="col-sm-4 col-md-2 control-label">Comment</label>
              <div class="col-sm-8 col-md-10">
                <textarea id="comment" class="form-control" name="comment" rows="5"><?= $newcomment->comment ?></textarea>
                <div class="help-block"><?= $errors['comment']; ?></div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
                <button class="btn btn-success">
                  <span class="glyphicon glyphicon-ok"></span> Add Comment
                </button>
              </div>
            </div>
          </form>
        <?php else: ?>
          <p>You need to be <a href="./?page=login">logged in</a> to add a comment.</p>
        <?php endif; ?>

      </div> <!-- /.post-preview -->
    </div> <!-- /.container -->
