<section class="post" data-image="<?php echo $post->Image;?>">
	<header class="major">
		<h2>
		<?php if (!empty($post->WebFilename)):?>
			<a href="?/post/<?php echo $post->WebFilename;?>/">
		<?php else :?>
			<a href="">
		<?php endif;?>
		<?php echo $post->Title;?></a></h2>
	<div class="meta">
	<?php if (!is_Null($post->Author)) :?>
		<time class="published" datetime="<?php echo date("Y-m-d",$post->Date);?>"><?php echo date("d.m.Y,H:i",$post->Date);?></time>,
 				<a href="#" class="author"><span class="name" rel="Author"><?php echo $post->Author->Name;?></span>
 				</a>
	<?php endif;?>
	</div>
	<?php if (!empty($post->Image)) :?>
			<img src="<?php echo $post->Image;?>">
		<?php endif;?>
	</header>
	<p><?php echo $Parsedown->text($post->Content);?></p>
	<?php if (!property_exists($post,"HTTPCode") || $post->HTTPCode !== 404) :?>
	<?php
		global $bootstrap;
		$units = $bootstrap->GetUnitsByImplementation("IPostUnit");
		if (count($units) != 0){
			foreach($units as $unit){
				$unit->Run();
			}
		}
	?>
	<?php endif;?>
</section>