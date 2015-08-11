<div class="user-info text-center">
  <div class="container">

    <div>
      <h1 class="text-center">Site Map</h1>
    </div>

  </div><!-- /.container -->
</div><!-- /.user-info -->

<div class="post">
  <div class="container">

	<?php if (static::$auth->check()): ?>
		<div class="col-sm-offset-5 col-sm-4">
			<ul class="sitemap">
				<li><a href="./">Dashboard</a></li>
				<li><a href="./?page=post.create">New Post</a></li>
				<li> Your Posts:
					<ul class="no-padding">
						<?php if (count($posts) > 0): ?>
					      <?php foreach ($posts as $post ): ?>
					        <li>
					            <a href="./?page=post&amp;id=<?= $post->id ?>">
					            	<?= $post->title ?>
					            </a>
					        </li> <!-- /.col-md-4 -->
					      <?php endforeach; ?>
					    <?php else: ?>
					      <p>You haven't created any posts yet.</p>
					    <?php endif; ?>
					</ul>
				</li>
				<li><a href="./?page=community">Community Rules</a></li>
				<li><a href="./?page=contact">Contact Us</a></li>
			</ul>
		</div>
	<?php else: ?>
		<div class="col-sm-offset-5 col-sm-4">
			<ul class="sitemap">
				<li><a href="./">Home</a></li>
				<li><a href="./#features">About Us</a></li>
				<li><a href="./">Login</a></li>
				<li><a href="./?page=register">Register</a></li>
				<li><a href="./?page=community">Community Rules</a></li>
				<li><a href="./?page=contact">Contact Us</a></li>
			</ul>
		</div>
	<?php endif; ?>

  </div> <!-- /.container -->
</div> <!-- /.post -->