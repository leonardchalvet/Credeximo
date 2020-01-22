<?php 
use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;
?>
<html>
  <head>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta property="og:image" content="<?= $document->global_img->url; ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/contact.css">

  </head>
  
  <body>

    <main>
      
      <?php include('common-header.php') ?>

      <section class="section-contact">
        <div class="wrapper">
          <div class="container-title">
            <?= RichText::asHtml($document->contact_title); ?>
            <?= RichText::asHtml($document->contact_text); ?>
          </div>
        

          <form method="post" onsubmit="return false;">
            <input type="hidden" name="sendto" value="<?= RichText::asText($document->contact_sendto); ?>" >
            <div class="container-col">
              <div class="col">
                <div class="container-input">
                  <div class="icn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g id="icn-form-1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.132 3.868c4.49 4.491 4.49 11.773 0 16.264-4.491 4.49-11.773 4.49-16.264 0-4.49-4.491-4.49-11.773 0-16.264 4.491-4.49 11.773-4.49 16.264 0M8.338 6.592a7.062 7.062 0 0 0 7.873 1.583"/>
                            <path d="M15.005 5.745a4.25 4.25 0 1 1-6.01 6.01 4.25 4.25 0 0 1 6.01-6.01M18.317 18.5a6.988 6.988 0 0 0-12.634 0"/>
                        </g>
                    </svg>
                  </div>
                  <input type="text" placeholder="<?= RichText::asText($document->contact_lastname); ?>" name="lastname">
                  <div class="text-error">
                    <?= RichText::asText($document->contact_error); ?>
                  </div>
                </div>
                <div class="container-input">
                  <div class="icn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g id="icn-form-1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.132 3.868c4.49 4.491 4.49 11.773 0 16.264-4.491 4.49-11.773 4.49-16.264 0-4.49-4.491-4.49-11.773 0-16.264 4.491-4.49 11.773-4.49 16.264 0M8.338 6.592a7.062 7.062 0 0 0 7.873 1.583"/>
                            <path d="M15.005 5.745a4.25 4.25 0 1 1-6.01 6.01 4.25 4.25 0 0 1 6.01-6.01M18.317 18.5a6.988 6.988 0 0 0-12.634 0"/>
                        </g>
                    </svg>
                  </div>
                  <input type="text" placeholder="<?= RichText::asText($document->contact_firstname); ?>" name="firstname">
                  <div class="text-error">
                    <?= RichText::asText($document->contact_error); ?>
                  </div>
                </div>
                <div class="container-input">
                  <div class="icn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25">
                      <g id="icn-form-3" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15.182 9.66a4.5 4.5 0 1 1-6.364 6.364 4.5 4.5 0 0 1 6.364-6.364"/>
                        <path d="M18.5 22.342c-5.242 3.595-12.406 2.26-16-2.982C-1.096 14.117.24 6.954 5.481 3.359c5.242-3.595 12.406-2.26 16 2.983a11.509 11.509 0 0 1 2.018 6.5v1a3.5 3.5 0 1 1-7 0v-1"/>
                      </g>
                    </svg>
                  </div>
                  <input type="text" placeholder="<?= RichText::asText($document->contact_email); ?>" name="email">
                  <div class="text-error">
                    <?= RichText::asText($document->contact_error); ?>
                  </div>
                </div>
                <div class="container-input">
                  <div class="icn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 24">
                      <g id="icn-form-4" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13.5 19.5H.5M7 21.25a.25.25 0 0 1 .25.25.25.25 0 0 1-.25.25.25.25 0 0 1-.25-.25.25.25 0 0 1 .25-.25"/>
                        <path d="M2.504 23.5a2 2 0 0 1-2-2v-19a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v19a2 2 0 0 1-2 2h-9z"/>
                      </g>
                    </svg>
                  </div>
                  <input type="text" placeholder="<?= RichText::asText($document->contact_phone); ?>" name="phone">
                  <div class="text-error">
                    <?= RichText::asText($document->contact_error); ?>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="container-input">
                  <div class="icn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 24">
                      <g id="icn-form-2" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 23.5H1.5A.5.5 0 0 1 1 23V9.5a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v14z"/>
                        <path d="M9 8.5v-7a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1V23a.5.5 0 0 1-.5.5H11"/>
                        <path d="M17 23.5V21a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 0-.5.5v2.5m-8 0V21a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 0-.5.5v2.5m-2-12h4m4-5h4m-4-3h6m-14 11h2"/>
                      </g>
                    </svg>
                  </div>
                  <input type="text" placeholder="<?= RichText::asText($document->contact_company); ?>" name="company">
                  <div class="text-error">
                    <?= RichText::asText($document->contact_error); ?>
                  </div>
                </div>
                <div class="container-textarea">
                  <textarea name="message" placeholder="<?= RichText::asText($document->contact_message); ?>" name="message"></textarea>
                </div>
                <button class="">
                  <span class="btn-text">
                    <?= RichText::asText($document->contact_btntext); ?>
                  </span>
                  <span class="btn-check">
                    ✓
                  </span>
                  <span class="btn-loading">
                    <span class="spin"></span>
                  </span>
                  <span class="btn-error">
                    <?= RichText::asText($document->contact_restart); ?>
                  </span>
                </button>
              </div>
            </div>
          </form>

        </div>
      </section>

      <?php include('common-footer.php') ?>

    </main>

    <script type="text/javascript" src="/script/minify/contact-min.js"></script>
  </body>
</html>