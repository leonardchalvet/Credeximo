<?php 
use Prismic\Dom\RichText;
$footer = $WPGLOBAL['footer']->data;
?>

<footer>

	<img class="logo" src="<?= $footer->logo->url; ?>" alt="">

	<div class="foot">
		<?= RichText::asHtml($footer->text); ?>
	</div>
	
</footer>