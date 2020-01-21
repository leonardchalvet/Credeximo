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
      
    $api = $prismic->get_api(); // PART 1 - Call api

    //PART 2 - Select languages
    $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $allLang = switchLanguages($language);
    $options = false;
    if($allLang) {
        foreach ($allLang as $lang) {
            $testReturn = $api->getByUID('header', 'header', [ 'lang' => $lang ] );
            if($testReturn) {
                $options = [ 'lang' => $lang ];
                break;
            }
        }
    }

    if(!$options) {
        header('HTTP/1.1 301 Moved Permanently', false, 301);
        header('Location: /'); // LANGUAGE 'MATER LOCAL'
        exit;
    }
    else {

        //PART 3 - Call Header & Footer & Lightbox
        $header   = $api->getByUID('header',   'header',   $options);
        $footer   = $api->getByUID('footer' ,  'footer',   $options);

        //PART 4 - Call Home
        $document = $api->query(Predicates::at('document.type', 'home'), $options);
        $document = $document->results[0];
        
        //PART 5 - Render the page
        render($app, 'home', array('document' => $document, 'header' => $header, 'footer' => $footer ));

    }

});

$app->get('/{header}', function ($request, $response, $args) use ($app, $prismic) {
    header('HTTP/1.1 301 Moved Permanently', false, 301);
    header('Location: /');
    exit;
});

$app->get('/{header}/', function ($request, $response, $args) use ($app, $prismic) {
    header('HTTP/1.1 301 Moved Permanently', false, 301);
    header('Location: /');
    exit;
});

//ADD LANGUAGES FOR MORE POSSIBILITIES
function switchLanguages($lg) {

    $lglg = '';
    switch (strtoupper($lg)) {

        case 'FR': return [ 'fr-fr', 'fr-be', 'fr-ca', 'fr-lu', 'fr-ch' ];
        case 'BE': return [ 'fr-be' ];

        case 'EN': return [ 'en-us', 'en-au', 'en-eu', 'en-bz', 'en-ca', 'en-de', 'en-gb', 'en-in', 'en-ie', 'en-jm', 'en-nz', 'en-ph', 'en-pl', 'en-za', 'en-tt' ];
        case 'US': return [ 'en-us', 'en-au', 'en-eu', 'en-bz', 'en-ca', 'en-de', 'en-gb', 'en-in', 'en-ie', 'en-jm', 'en-nz', 'en-ph', 'en-pl', 'en-za', 'en-tt' ];
        
        case 'DE': return [ 'de-at', 'de-de', 'de-li', 'de-lu', 'de-ch' ];
        case 'LU': return [ 'de-lu' ];
        
        case 'ES': return [ 'es-ar', 'es-bo', 'es-cl', 'es-co', 'es-cr', 'es-do', 'es-ec', 'es-sv', 'es-gt', 'es-hn', 'es-mx', 'es-ni', 'es-pa', 'es-py', 'es-pe', 'es-pr', 'es-es', 'es-uy', 'es-ve' ];
        case 'IT': return [ 'it-it', 'it-ch' ];
        
        case 'NL': return [ 'nl-nl' ];

        case 'JP': return [ 'ja-jp' ];
        
        default: return false;
    }
}