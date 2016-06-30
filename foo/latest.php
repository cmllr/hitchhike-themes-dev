<?php if (count($posts) > 0) :?>
<?php 
	$featured = null;
	if (count($posts) >= 2){
		$featured = array_shift($posts);
	}
	function GetImages($raw){
		$pattern = "/\\!\\[[^\\]]+\\]\\((?<image>[^\\)]+)\\)/";
		$matches = array();
		preg_match_all($pattern, $raw, $matches);

		return $matches["image"];
	}
?>
<?php if (!is_null($featured)) :?>
	<div class="row featured">
		<div class="col-lg-5">			
			<h1><a href="?/post/<?php echo $featured->WebFilename;?>/"><?php echo $featured->Title;?></a></h1>
			<p class="featured-content"><?php echo \BTRString::SubStrClause(strip_tags($Parsedown->text($featured->Content)),5,true)."...";?></p>
			<span class="">
				<?php if (count($featured->Tags) > 0)  :?>
					<?php foreach($featured->Tags as $tag) :?>
						<a class="label label-tag" href="?/tag/<?php echo $tag;?>/"><?php echo $tag;?></a>
					<?php endforeach;?>
				<?php endif;?>
			</span>
		</div>
		<div class="col-lg-5">
			<?php
				$got = (GetImages($featured->Content));
				if (count($got) != 0 && empty($featured->Image)){
					$index = rand(0,count($got) -1);
					$featured->Image = $got[$index];
				}
			?>
			<div class="image-preview">
				<?php if (!empty($featured->Image)) :?>
					<img src="<?php echo $featured->Image;?>">
				<?php else :?>
					<img src="https://snap-photos.s3.amazonaws.com/img-thumbs/960w/0ONPV3AA0W.jpg">
				<?php endif;?>
			</div>
			<?php echo $featured->Author->Name;?>,
			<span class="date"><?php echo date("Y-m-d H:i:s",$post->Date);?></span>
		</div>
	</div>
<?php endif;?>
<?php foreach($posts as $post) :?>
	<div class="post-preview col-lg-5">
		<?php
			$got = (GetImages($post->Content));
			if (count($got) != 0 && empty($post->Image)){
				$index = rand(0,count($got) -1);
				$post->Image = $got[$index];
			}
		?>
		<div class="image-preview">
			<?php if (!empty($post->Image)) :?>
				<img src="<?php echo $post->Image;?>">
			<?php else :?>
				<img src="https://snap-photos.s3.amazonaws.com/img-thumbs/960w/0ONPV3AA0W.jpg">
			<?php endif;?>
		</div>
		<h2><a href="?/post/<?php echo $post->WebFilename;?>/"><?php echo $post->Title;?></a></h2>
		<?php echo $post->Author->Name;?>,
		<span class="date"><?php echo date("Y-m-d H:i:s",$post->Date);?></span>
		<span class="tags">
			<?php if (count($post->Tags) > 0)  :?>
				<?php foreach($post->Tags as $tag) :?>
					<a class="label label-tag" href="?/tag/<?php echo $tag;?>/"><?php echo $tag;?></a>
				<?php endforeach;?>
			<?php endif;?>
		</span>
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
	<div class="btn-group" role="group" aria-label="...">
		<?php if ($canGoBack) :?>
		<a href="index.php?/&site=<?php echo $currentSite-1;?><?php echo $suffix;?>"><button type="button" class="btn btn-default"><?php echo $translation["prevpage"];?></button></a>
		<?php endif;?>	
		<?php if ($canGoForward) :?>
		<a href="index.php?/&site=<?php echo $currentSite+1;?><?php echo $suffix;?>">  <button type="button" class="btn btn-default"><?php echo $translation["nextpage"];?></button></a>
		<?php endif;?>
	</div>
<?php endif;?>