<?php

require_once '../include/DbConnect.php';
require '.././libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

session_start();

$app = new \Slim\Slim();

$app->get('/', function () use ($app) {

	$db = new DbConnect();
	$stmt = $db->connect()->prepare( 'SELECT * FROM issue;' );
	$stmt->execute();
    $result = $stmt->get_result();
	$stmt->close();
		
	while ( $row = $result->fetch_assoc() ) {
		$data[] = $row;
	}

	$msg = NULL;
	if(isset($_SESSION['slim.flash']['msg'])){
		$msg = $_SESSION['slim.flash']['msg'];
	}
	
	$app->render('issue-list.php', array(
			'page_title' => "inSite - Issue List",
			'data' => $data,
			'msg' => $msg
		)
	);
});

$app->get('/issue/:id', function ($issue_id) use ($app) {
	
	$db = new DbConnect();
	$stmt = $db->connect()->prepare("SELECT * from issue WHERE id = ?");
        $stmt->bind_param("i", $issue_id);
        if ($stmt->execute()) {
            $issue = $stmt->get_result()->fetch_assoc();
			$issue['date_time'] = date_format(date_create($issue['date_reported']), 'l, jS F Y') . ' / ' . date_format(date_create($issue['time_reported']), 'g:ia');
			$issue['full_location'] = $issue['location_name'] . ' (' . $issue['latitude'] . ', ' . $issue['longitude'] . ')';
			
			$issue['image_display'] = NULL;
			if($issue['image_path'] != NULL){
				$issue['image_display'] = '<img src="../../' . $issue['image_path'] . '" /><br /><br />';
			}
			
            
            $stmt->close();

        } else {
            $issue = NULL;
        }
	
	$msg = NULL;
	if(isset($_SESSION['slim.flash']['msg'])){
		$msg = $_SESSION['slim.flash']['msg'];
	}
	
	$app->render('edit.php', array(
			'page_title' => "inSite - Update Issue",
			'data' => $issue,
			'msg' => $msg
		)
	);
});

$app->post('/issue/:id', function($issue_id) use ($app) {
	
	$status = $app->request()->post('status');
	$status_comment = $app->request()->post('status_comment');
	
	$db = new DbConnect();
	$stmt = $db->connect()->prepare("UPDATE issue set status = ?, status_comment = ? WHERE id = ?");
    $stmt->bind_param("ssi", $status, $status_comment, $issue_id);
    $stmt->execute();
    $num_affected_rows = $stmt->affected_rows;
    $stmt->close();

	if($num_affected_rows > 0){
		$app->flash('msg', 'Issue has been updated successfully!');
		$app->redirect('../');
	}
	else{
		$app->flash('msg', 'Error in updating the issue!');
		$app->redirect('../issue/' . $issue_id);
	}

});


$app->run();