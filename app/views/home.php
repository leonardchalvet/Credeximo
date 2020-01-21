<?php 
use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;
?>
<html>
  <head>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/home.css">

  </head>
  
  <body>

    <main>
      
      <?php include('common-header.php') ?>

      <section class="section-cover">
        <div class="background"></div>
        <div class="wrapper">
          <?= RichText::asHtml($document->cover_title); ?>
          <div class="container-mail">
            <form method="post" action="<?= $document->cover_btnlink->url; ?>">
              <input type="hidden" name="sendto" value="<?= RichText::asText($document->cover_sendto); ?>" >
              <input type="text" name="email" placeholder="<?= RichText::asText($document->cover_placeholder); ?>">
              <button>
                <span class="btn-text"><?= RichText::asText($document->cover_btntext); ?></span>
              </button>
            </form>
          </div>
        </div>
      </section>

      <section id="anchor-section-features" class="section-features">
        <div class="wrapper">

          <div class="container-title">
            <?= RichText::asHtml($document->features_title); ?>
          </div>

          <div class="container-el">
            
            <?php $i = 1;
                  foreach ($document->features_allfeatures as $feature) { ?>     
              <div class="el">
                <?php if($i==2) { ?>
                  <div class="img">
                    <img src="<?= $feature->allfeatures_photo->url; ?>" alt="">
                  </div>
                <?php } ?>
                <div class="text">
                  <?= RichText::asHtml($feature->allfeatures_subtitle); ?>
                  <?= RichText::asHtml($feature->allfeatures_text); ?>
                </div>
                <?php if($i==1) { ?>
                  <div class="img">
                    <img src="img/img-test/background-1.jpg" alt="">
                  </div>
                <?php } ?>
              </div>
            <?php $i++; } ?>

          </div>
        </div>
      </section>

      <section id="anchor-section-team" class="section-team">
        <div class="background"></div>
        <div class="wrapper">
          <div class="container-title">
            <?= RichText::asHtml($document->team_title); ?>
            <div class="desc">
              <?= RichText::asHtml($document->team_text); ?>
              <a href="<?= $document->team_btnlink->url; ?>">
                <span class="btn-text"><?= RichText::asText($document->team_btntext); ?></span>
              </a>
            </div>
          </div>
          <div class="container-team">
            <?php foreach ($document->team_allteam as $team) { ?>
              <div class="team">
                <img src="<?= $team->allteam_photo->url; ?>" alt="">
                <div class="text">
                  <div class="name"><?= RichText::asText($team->allteam_name); ?></div>
                  <?= RichText::asHtml($team->allteam_text); ?>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <section class="section-place">
        <div class="wrapper">
          <div class="container-title">
            <?= RichText::asHtml($document->place_title); ?>
            <?= RichText::asHtml($document->place_text); ?>
          </div>
          <div class="container-places">
            <?php foreach ($document->place_allplace as $place) { ?>
              <div class="place">
                <div class="title"><?= RichText::asText($place->allplace_subtitle); ?></div>
                <?= RichText::asHtml($place->allplace_text); ?>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <?php include('common-footer.php') ?>

    </main>

    <script type="text/javascript" src="/script/minify/index-min.js"></script>
  </body>
</html>