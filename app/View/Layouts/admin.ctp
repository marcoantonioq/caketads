<?php $cakeDescription = 'TADS Turma 2011'; ?>

<!DOCTYPE html>
	<html lang=''>
	<head>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta charset="utf-8">
			<?php echo $this->Html->charset(); ?>
			<title>
				<?php echo $cakeDescription ?>:
				<?php echo $title_for_layout; ?>
			</title>
			<?php
				echo $this->Html->meta('icon');
				echo $this->Html->css(array('cake.generic', 'layout'));
				echo $this->fetch('meta');
				echo $this->fetch('css');
				echo $this->fetch('script');
			?>
	</head>
	<body>
		<header>
			<h2>ADMIN - HEADER <?php echo $cakeDescription ?></h2>
		</header>
		
		<nav>
			<?php echo $this->element('admin_nav'); ?>
		</nav>

		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>

		<section>
			<article>
				<div id="footer">
					
				</div>
		  	</article>
		</section>
		<footer>
			<h3>footer</h3>
		</footer>
		<?php echo $this->element('sql_dump'); ?>
	</body>
</html>