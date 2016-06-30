<?php if (count($posts) > 0) :?>
<?php foreach($posts as $post) :?>
	<div class="post">
		<h2><a href="?/post/<?php echo $post->WebFilename;?>/" class="accent-fg"><?php echo $post->Title;?></a></h2>
		<?php if (!empty($post->Image)) :?>
			<img src="<?php echo $post->Image;?>">
		<?php endif;?>
		<p><?php echo \BTRString::SubStrClause(strip_tags($Parsedown->text($post->Content)),2,true)."...";?></p>
		<a href="?/post/<?php echo $post->WebFilename;?>/" class="accent-fg nodeco" ><?php echo $translation["continuereading"];?></a>
		
	</div>
<?php endforeach;?>
	

<!-- Pagination -->
	<?php
		$suffix = isset($php->post->query) ? "&query=".$php->post->query : "";
		if (empty($suffix) && isset($php->get->query)){
			$suffix = "&query=".$php->get->query;
		}
		$canGoBack = $currentSite -1 != 0;
		$canGoForward = $currentSite < $max;

	?>
		<?php if ($canGoBack) :?>
		<a href="index.php?/&site=<?php echo $currentSite-1;?><?php echo $suffix;?>" class="	button  previous"><?php echo $translation["prevpage"];?></a>
		<?php endif;?>
		<?php if ($canGoForward) :?>
		<a href="index.php?/&site=<?php echo $currentSite+1;?><?php echo $suffix;?>" class="button  next"><?php echo $translation["nextpage"];?></a>
		<?php endif;?>
<?php endif;?>