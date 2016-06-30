<?php global $blog;?>
<?php global $translation;?>
<?php $Parsedown = new Parsedown();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="Content-Language" content="<?php echo $blog->Language;?>"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	global $bootstrap;
	$units = $bootstrap->GetUnitsByImplementation("IHeadUnit");
	foreach($units as $unit){
		$unit->Run();
	}
	?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href="./themes/foo/simple.css" rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="./themes/foo/font-awesome-4.6.1/css/font-awesome.min.css">
	<link rel="stylesheet" href="./themes/foo/animate.css">
	<link rel="alternate" type="application/rss+xml" href="?/feed/" />
	<title><?php echo $title;?></title>
</head>
	<div class="container">
		<div class="row">
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<?php if (!is_null($post)) :?>
						<ul class="nav navbar-nav">
						  <li><a href="."><i class="fa fa-home"></i>1</a>
			              <li class="active"><a href="?/post/<?php echo $post->WebFilename;?>/"><?php echo $post->Title;?> <span class="sr-only">(current)</span></a></li>
			            </ul>
		        	<?php endif;?>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<form class="navbar-form navbar-right" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</form>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div>	
		<div class="row  main-row">
			<h1><a href="."><?php echo $blog->Name;?></a></h1>
			<span class="subtitle"><?php echo $blog->Subtitle;?></span>
		</div>	
		<div class="row">	
			<div class="col-lg-2 left ad">	
				<?php
				global $bootstrap;
				$units = $bootstrap->GetUnitsByImplementation("ISideUnit");
				if (count($units) != 0){
					foreach($units as $unit){
						$unit->Run();
					}
				}
				?>
			</div>		
			<div class="col-lg-8 main">
				<?php
				require_once $innerContent;
				?>
			</div>
		</div>

		<div class="row">
			<footer>
			<div class="col-sm-2">
			</div>
			<div class="col-lg-8">
				<ul>	
					<li><a href="#">&copy; <?php echo $blog->Copyright;?></a></li>
					<?php if (count($sites) != 0) :?>
						<?php foreach($sites as $site):?>
							<li><a href="?/post/<?php echo $site->WebFilename;?>/"><?php echo $site->Title;?></a></li>
						<?php endforeach;?>
					<?php endif;?>

				</ul>
			</div>
			</footer>
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script type="text/javascript">
	$(".date").each(function(){
		var old = $(this).text();
		console.log(old)
		$(this).text(moment(old).fromNow());
	});
</script>
</html>
