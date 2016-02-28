<?php

$opts = new stdClass();
$opts->servername= "localhost";
$opts->username = "confer";
$opts->password = "confer0123";
$opts->dbname = "myconference";
$conn = new mysqli($opts->servername, $opts->username, $opts->password, $opts->dbname);

require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

# $base_path = "/myconference/api";
$base_path = "";

$app = new Silex\Application();
$app['debug'] = true;
$app->GET('/', function(Application $app, Request $request) {
	global $conn;
	$search_term = $request->get('q');
	$meta = '';
	$meta['type'] = 'search';
	$meta['term'] = $search_term;

	$list = array();
	$sql = "SELECT * FROM conference_year WHERE full_name LIKE \"%$search_term%\"";
	$result = $conn->query($sql);
	if ($result->num_rows > 0 ) {
		$a = null;
		while ($r = $result->fetch_assoc()) {
			$a['conference_year_id'] = $r['conference_year_id'];
			$a['full_name']  = $r['full_name'];
			$a['short_name'] = $r['short_name'];
			array_push($list,$a);
		}
		$response['status'] = "OK";
	} else {
		$response['status'] = "NO RECORDS";
	}
	$conn->close();

	$meta['num_results'] = $result->num_rows;
	$response['meta'] = $meta;
	$response['results'] = $list;

	$json = json_encode($response, JSON_PRETTY_PRINT);
	return new Response($json);
});


$app->GET($base_path.'/conference', function(Application $app, Request $request) {
	global $opts;
	$id = $request->get('id');    


	$return_arr = array();
	if ($conn->connect_error) {
		$return_arr['status'] = "DB_ERROR";
	} else {
		$sql = "SELECT * FROM conference_year WHERE conference_year_id=".$id;
		$result = $conn->query($sql);
		if ($result->num_rows > 0 ) {
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
