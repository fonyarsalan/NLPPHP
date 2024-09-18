<?php

require('./vendor/autoload.php');

use \Google\Cloud\Laguage\LanguageClient;

$language = new LanguageClient();

// analyze sentence
$annotation = $language->annotateText('Greetings from Lahore, Pakistan');

// Check sentiment
if($annotation->sentiment()>0){
    echo "this is a positive message";
}

// detect entities
$entities  = $annotation->entitiesByTpe('LOCATION');

foreach($entities as $entity){
    echo $entity['name']. '\n';
}

// parse syntax
$tokens = $annotation->tokenByTag('NOUN');

foreach($tokens as $token){
    echo  $token['text']['content0']. '\n';
}