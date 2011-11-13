<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

foreach ($posts as $key => $post) : ?>

<article class="thread">
	<?php if(isset($post['op'])) :
		$op = $post['op'];
	?>
	<header id="<?php echo $op->num ?>">
		<h2 class="post_title"><?php echo $op->title ?></h2>
		<span class="post_author"><?php echo $op->name ?></span>
		<span class="post_trip"><?php echo $op->trip ?></span>
		<time datetime="<?php echo date(DATE_W3C, $op->timestamp) ?>"><?php date('D M d H:i:s Y', $op->timestamp) ?></time>
		<span class="post_number"><a href="<?php echo site_url($this->fu_board . '/thread/' . $op->num) ?>">No.</a><a href="<?php echo site_url($this->fu_board . '/thread/' . $op->num) . '#q' . $op->num ?>"><?php echo $op->num ?></a></span>
		<span class="post_controls">[<a href="<?php echo site_url($this->fu_board . '/thread/' . $op->num) ?>">Reply</a>] [<a href="http://boards.4chan.org/<?php echo $this->fu_board . '/res/' . $op->num ?>">Original</a>] [<a href="<?php echo site_url($this->fu_board . '/report/' . $op->num) ?>">Report</a>]</span>

		<?php if ($op->media_filename) : ?>
		<br/>
		<span class="post_file">File: <?php echo byte_format($op->media_size, 0) . ', ' . $op->media_w . 'x' . $op->media_h . ', ' . $op->media ?></span>
		<span class="post_file_controls">[<a href="<?php echo site_url($this->fu_board . '/image/' . urlencode(substr($op->media_hash, 0, -2))) ?>">View Same</a>] [<a href="http://iqdb.org/?url=<?php echo urlencode($op->thumbnail_href) ?>">iqdb</a>]</span>
		<?php endif; ?>
	</header>
	<?php if ($op->media_filename) : ?>
	<img src="<?php echo $op->thumbnail_href ?>" class="thread_image" />
	<?php endif; ?>
	<div class="text">
		<?php echo $op->comment_processed ?>
		<?php echo ((isset($post['omitted']) && $post['omitted'] > 0)?'<h6>' . $post['omitted'] . ' posts omitted.</h6>':'') ?>
	</div>
	<?php endif; ?>
	<aside class="posts">
		<?php 
		$post_count = 0;
		foreach (array_reverse($post['posts']) as $p) : 
		
			if(isset($posts_per_thread) && $posts_per_thread == $post_count)
			{
				break;
			}
			$post_count++;
		?>
		<?php if ($p->subnum > 0) : ?>
		<article class="post" id="<?php echo $p->num . '_' . $p->subnum ?>">
			<header>
				<span class="post_author"><?php echo $p->name ?></span>
				<span class="post_trip"><?php echo $p->trip ?></span>
				<time datetime="<?php echo date(DATE_W3C, $p->timestamp) ?>"><?php echo date('D M d H:i:s Y', $p->timestamp) ?></time>
				<span class="post_number"><a href="<?php echo site_url($this->fu_board . '/thread/' . $p->parent) . '#' . $p->num . '_' . $p->subnum ?>">No.</a><a href="<?php echo site_url($this->fu_board . '/thread/' . $p->parent) . '#q' . $p->num . '_' . $p->subnum ?>"><?php echo $p->num . ',' . $p->subnum ?></a></span>
				<span class="post_controls">[<a href="<?php echo site_url($this->fu_board . '/report/' . $p->num) ?>">Report</a>]</span>
				<span class="post_ghost">This is not an archived reply.</span>
		<?php else : ?>
		<article class="post" id="<?php echo $p->num ?>">
			<header>
				<span class="post_author"><?php echo $p->name ?></span>
				<span class="post_trip"><?php echo $p->trip ?></span>
				<time datetime="<?php echo date(DATE_W3C, $p->timestamp) ?>"><?php echo date('D M d H:i:s Y', $p->timestamp) ?></time>
				<span class="post_number"><a href="<?php echo site_url($this->fu_board . '/thread/' . $p->parent) . '#' . $p->num ?>">No.</a><a href="<?php echo site_url($this->fu_board . '/thread/' . $p->parent) . '#q' . $p->num ?>"><?php echo $p->num ?></a></span>
				<span class="post_controls">[<a href="<?php echo site_url($this->fu_board . '/report/' . $p->num) ?>">Report</a>]</span>
				<?php endif; ?>
				<?php if ($p->media_filename) : ?>
				<br/>
				<span class="post_file">File: <?php echo byte_format($p->media_size, 0) . ', ' . $p->media_w . 'x' . $p->media_h . ', ' . $p->media ?></span>
				<span class="post_file_controls">[<a href="<?php echo site_url($this->fu_board . '/image/' . urlencode(substr($p->media_hash, 0, -2))) ?>">View Same</a>] [<a href="http://iqdb.org/?url=<?php echo urlencode($p->thumbnail_href) ?>">iqdb</a>]</span>
				<?php endif; ?>
			</header>
		<?php if ($p->media_filename) : ?>
		<img src="<?php echo $p->thumbnail_href ?>" class="post_image" />
		<?php endif; ?>
			<div class="text">
				<?php echo $p->comment_processed ?>
			</div>
		</article>
		<div style="clear:right"></div>
	<?php endforeach; ?>
	</aside>
	<div class="clearfix"></div>
</article>
<?php endforeach; ?>