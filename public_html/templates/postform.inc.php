<?php
  $errors = $post->errors;
  $verb = ( $post->id? "Edit" : "Add" );
  if ($post->id) {
    $submitAction = "./?page=post.update";
  } else {
    $submitAction = "./?page=post.store";
  }
?>

<div class="post">
  <div class="container" id="form-edit">

    <form method="POST" action="<?= $submitAction ?>" class="form-horizontal" enctype="multipart/form-data">
    <?php if($post->id): ?>
      <input type="hidden" name="id" value="<?= $post->id ?>">
    <?php endif; ?>
      <h2 class="text-center"><?= $verb; ?> Post</h2>

        <div class="form-group form-group-lg<?php if ($errors['title']): ?> has-error <?php endif; ?>">
          <label for="title" class="col-sm-4 col-md-2 control-label">Post Title</label>
          <div class="col-sm-8 col-md-10">
            <input id="title" class="form-control input-lg" name="title"
              placeholder="My Great Post"
              value="<?= $post->title; ?>">
            <div class="help-block"><?= $errors['title']; ?></div>
          </div>
        </div>

        <div class="form-group <?php if ($errors['content']): ?> has-error <?php endif; ?>">
          <label for="content" class="col-sm-4 col-md-2  control-label">Content:</label>
          <div class="col-sm-8 col-md-10">
            <textarea id="content" class="form-control" name="content" rows="5"
              placeholder="Write your post here..."><?= $post->content; ?></textarea>
            <div class="help-block"><?= $errors['content']; ?></div>
          </div>
        </div>

        <div class="form-group form-group-lg<?php if ($errors['tags']): ?> has-error <?php endif; ?>">
          <label for="tags" class="col-sm-4 col-md-2 control-label">Tags</label>
          <div class="col-sm-8 col-md-10">
            <div id="tags" class="form-control"></div>
            <script>
              var inputTags = "<?= $post->tags ?>";
            </script>
            <div class="help-block"><?= $errors['tags']; ?></div>
          </div>
        </div>

        <div class="form-group form-group-lg<?php if ($errors['feature_img']): ?> has-error <?php endif; ?>">
        <label for="feature_img" class="col-sm-4 col-md-2 control-label">Feature Image</label>
        <div class="col-sm-5 col-md-7">
          <input id="feature_img" class="form-control input-lg" name="feature_img"
            type="file">
          <div class="help-block"><?= $errors['feature_img']; ?></div>
        </div>
        <?php if($post->feature_img != ""): ?>
          <div class="col-sm-1 col-md-1">
            <img src="./images/features/100h/<?= $post->feature_img ?>" alt="">
          </div>
          <div class="col-sm-2 col-md-2">
            <div class="checkbox">
              <label><input type="checkbox" name="remove-image" value="TRUE"> Remove Image</label>
            </div>
          </div>
        <?php else: ?>
          <div class="col-sm-3 col-md-3">
            <p><small>no feature image found</small></p>
          </div>
        <?php endif; ?>
      </div>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
            <button class="btn btn-comment">
              <span class="glyphicon glyphicon-ok"></span> <?= $verb; ?> post
              </button>
          </div>
        </div>

    </form>

    <?php if ($post->id): ?>
      <form method="POST" action="./?page=post.destroy" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
            <input type="hidden" name="id" value="<?= $post->id ?>">
            <button class="btn btn-comment">
              <span class="glyphicon glyphicon-trash"></span> Delete Post
            </button>
          </div>
        </div>
      </form>
    <?php endif; ?>
    
  </div> <!-- /.container -->
</div> <!-- /.post-preview -->