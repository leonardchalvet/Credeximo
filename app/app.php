<?php

/*
 * This is the main file of the application, including routing and controllers.
 *
 * $app is a Slim application instance, see the framework documentation for more details:
 * http://docs.slimframework.com/
 *
 * The order of the routes matter, as it will define the priority of routes. For that reason we
 * need to keep the more "generic" routes, such as the pages route, at the end of the file.
 *
 * If you decide to change the URLs, make sure to change PrismicLinkResolver in LinkResolver.php
 * as well to make sures links in your site are correctly generated.
 *
 * DEL COOCKIES
 * if (isset($_SERVER['HTTP_COOKIE'])) {
 *    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
 *    foreach($cookies as $cookie) {
 *        $parts = explode('=', $cookie);
 *        $name = trim($parts[0]);
 *        setcookie($name, '', time()-1000);
 *        setcookie($name, '', time()-1000, '/');
 *    }
 * }
 * 
 */

use Prismic\Api;
use Prismic\Predicates;
    
use Prismic\LinkResolver;
use Prismic\Dom\RichText;
use Prismic\Dom\Link;

require_once 'includes/http.php';

$apiEndpoint = $WPGLOBAL['app']->getContainer()->get('settings')['prismic.url'];
$repoEndpoint = str_replace("/api", "", $apiEndpoint);
$url = $repoEndpoint . '/app/settings/onboarding/run';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("language=php&framework=slim"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec ($ch);
curl_close ($ch);

/*
 *  --[ INSERT YOUR ROUTES HERE ]--
 */

// Index page
$app->get('/', function ($request, $response) use ($app, $prismic) {
      
    $api = $prismic->get_api();

    $header   = $api->getByUID('header',  'header');
    $footer   = $api->getByUID('footer' , 'footer');

    $document = $api->query(Predicates::at('document.type', 'home'), $options);
    $document = $document->results[0];
        
    render($app, 'home', array('document' => $document, 'header' => $header, 'footer' => $footer));

});

// Call page with language and name => https://url.com/language/namepage
$app->map(['GET', 'POST'], '/{uid}', function ($request, $response, $args) use ($app, $prismic) {
    renderPage($request, $response, $args, $app, $prismic);
});

$app->get('/{location}/', function ($request, $response, $args) use ($app, $prismic) {
    header('HTTP/1.1 301 Moved Permanently', false, 301);
    header('Location: /'.$args['location']);
    exit;
});

function renderPage($request, $response, $args, $app, $prismic) {

    $api = $prismic->get_api();

    $header   = $api->getByUID('header',  'header');
    $footer   = $api->getByUID('footer' , 'footer');

    $document = NULL;
    $nType = 0;
    $arrayTypes = [ 'contact' ];
    $arrayView  = [ 'contact' ];
    foreach ($arrayTypes as $type) {
        $document = $api->getByUID($type, $args['uid']);
        
        $nType++;
        if($document != NULL) {
            break;
        }
    }

    if($document != NULL) {
      render($app, $arrayView[$nType-1], array('document' => $document, 'header' => $header, 'footer' => $footer));
    }
    else {
      header('HTTP/1.1 301 Moved Permanently', false, 301);
      header('Location: /');
      exit;
    }
}