<?php

$server_name= "localhost";
$username = "confer";
$password = "confer0123";
$dbname = "myconference";

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
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$return_arr = array();
	if ($conn->connect_error) {
		$return_arr['status'] = "DB_ERROR";
	} else {
		$sql = "SELECT * FROM conference_year WHERE conference_year_id=".$id;

		$result_q = $conn->query($sql); 
		if ($result->num_rows >0 ) {
			while ($row = $result->fetch_assoc()) {
			    $row_array['conference_year_id'] = $row['conference_year_id'];
			    $row_array['full_name'] = $row['full_name'];
			    $row_array['short_name'] = $row['short_name'];
			    $row_array['year'] = $row['year'];
			    $row_array['location'] = $row['location'];
			    $row_array['start_date'] = $row['start_date'];
			    $row_array['end_date'] = $row['end_date'];
			    $row_array['pre_sub_date'] = $row['pre_sub_date'];
			    $row_array['sub_date'] = $row['sub_date'];	    

			    array_push($return_arr,$row_array);
			}
			$return_arr['status'] = "OK";			
		} else {
			$return_arr['status'] = "NO RECORDS";
		}
	}
	$conn->close();
	$output = json_encode($return_arr);
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
