<?php
  $errors = $comment->errors;
?>

<div class="post">
  <div class="container" id="form-edit">

    <form method="POST" action="./?page=comment.update" class="form-horizontal" enctype="multipart/form-data">
    <?php if($comment->id): ?>
      <input type="hidden" name="id" value="<?= $comment->id ?>">
    <?php endif; ?>
      <h2 class="text-center">Edit Comment</h2>

        <div class="form-group <?php if ($errors['comment']): ?> has-error <?php endif; ?>">
          <div class="col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10">
            <textarea id="comment" class="form-control" name="comment" rows="5"><?= $comment->comment; ?></textarea>
            <div class="help-block"><?= $errors['comment']; ?></div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-10">
            <button class="btn btn-comment">
              <span class="glyphicon glyphicon-ok"></span> Edit Comment
              </button>
          </div>
        </div>

    </form>

    <?php if ($comment->id): ?>
      <form method="POST" action="./?page=comment.destroy" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-10">
            <input type="hidden" name="id" value="<?= $comment->id ?>">
            <button class="btn btn-comment">
              <span class="glyphicon glyphicon-trash"></span> Delete Comment
            </button>
          </div>
        </div>
      </form>
    <?php endif; ?>
    
  </div> <!-- /.container -->
</div> <!-- /.post-preview -->
