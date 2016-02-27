<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
$base_path = "/myconference/api";
$app = new Silex\Application();
//$app['debug'] = true;
$app->GET('/', function(Application $app, Request $request) {
	return new Response("default // redirect");
});


$app->GET($base_path.'/conference', function(Application $app, Request $request) {
	$id = $request->get('id');    
	
	// call mysql 
	
	$obj = '';
	$obj['conference_id'] = $id;
	$list[] = $obj;
	
	$result = '';
	$result['results'] = $list;
	$result['status'] = "OK";
	$output = json_encode($result);
	return new Response($output);
});

            

$app->GET($base_path.'/conferences', function(Application $app, Request $request) {
            $size = $request->get('size');    
            
            return new Response('How about implementing conferencesGET as a GET method ?');
            });

            

$app->GET($base_path.'/search', function(Application $app, Request $request) {
            $q = $request->get('q');    $size = $request->get('size');    
            
            return new Response('How about implementing searchGET as a GET method ?');
            });

            

$app->GET($base_path.'/user', function(Application $app, Request $request) {
            $id = $request->get('id');    
            
            return new Response('How about implementing userGET as a GET method ?');
            });

            
        
    

$app->run();
