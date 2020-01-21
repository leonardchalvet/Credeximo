<?php 
use Prismic\Dom\RichText;
$header = $WPGLOBAL['header']->data;
?>

<header>
	<img class="logo" src="<?= $header->logo->url; ?>" alt="">
	<div class="container-link">
		<a href="#anchor-section-features"><?= RichText::asText($header->links_mission); ?></a>
		<a href="#anchor-section-team"><?= RichText::asText($header->links_team); ?></a>
	</div>
	<a href="<?= $header->cta_btnlink->url; ?>" class="btn">
		<span class="btn-text">
			<?= RichText::asText($header->cta_btntext); ?>
		</span>
	</a>
</header>