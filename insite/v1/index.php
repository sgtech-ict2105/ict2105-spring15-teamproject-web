<?php
 
require_once '../include/DbHandler.php';
require_once '../include/PassHash.php';
require '.././libs/Slim/Slim.php';
 
\Slim\Slim::registerAutoloader();
 
$app = new \Slim\Slim();
 
// User id from db - Global Variable
$user_id = NULL;
 
/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }
 
    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoResponse(400, $response);
        $app->stop();
    }
}
 
/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoResponse(400, $response);
        $app->stop();
    }
}
 
/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
 
    // setting response content type to json
    $app->contentType('application/json');
 
    echo json_encode($response);
}

/**
 * User Registration
 * url - /register
 * method - POST
 * params - name, email, password
 */
$app->post('/register', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('name', 'email', 'password'));
 
            $response = array();
 
            // reading post params
            $name = $app->request->post('name');
            $email = $app->request->post('email');
            $password = $app->request->post('password');
 
            // validating email address
            validateEmail($email);
 
            $db = new DbHandler();
            $res = $db->createUser($name, $email, $password);
 
            if ($res == USER_CREATED_SUCCESSFULLY) {
                $response["error"] = false;
                $response["message"] = "You are successfully registered";
                echoResponse(201, $response);
            } else if ($res == USER_CREATE_FAILED) {
                $response["error"] = true;
                $response["message"] = "Oops! An error occurred while registereing";
                echoResponse(200, $response);
            } else if ($res == USER_ALREADY_EXISTED) {
                $response["error"] = true;
                $response["message"] = "Sorry, this email already existed";
                echoResponse(200, $response);
            }
        });
		
		
/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
$app->post('/login', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('email', 'password'));
 
            // reading post params
            $email = $app->request()->post('email');
            $password = $app->request()->post('password');
            $response = array();
 
            $db = new DbHandler();
            // check for correct email and password
            if ($db->checkLogin($email, $password)) {
                // get the user by email
                $user = $db->getUserByEmail($email);
 
                if ($user != NULL) {
                    $response["error"] = false;
                    $response['name'] = $user['name'];
                    $response['email'] = $user['email'];
                    $response['apiKey'] = $user['api_key'];
                    $response['createdAt'] = $user['created_at'];
                } else {
                    // unknown error occurred
                    $response['error'] = true;
                    $response['message'] = "An error occurred. Please try again";
                }
            } else {
                // user credentials are wrong
                $response['error'] = true;
                $response['message'] = 'Login failed. Incorrect credentials';
            }
 
            echoResponse(200, $response);
        });

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();
 
    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        $db = new DbHandler();
 
        // get the api key
        $api_key = $headers['Authorization'];
        // validating api key
        if (!$db->isValidApiKey($api_key)) {
            // api key is not present in users table
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid Api key";
            echoResponse(401, $response);
            $app->stop();
        } else {
            global $user_id;
            // get user primary key id
            $user = $db->getUserId($api_key);
            if ($user != NULL)
                $user_id = $user["id"];
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Api key is misssing";
        echoResponse(400, $response);
        $app->stop();
    }
}


/**
 * Creating new issue in db
 * method POST
 * params - name
 * url - /issue/
 */
$app->post('/issue', 'authenticate', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('issue_name', 'description', 'location_name',
            						'date_reported', 'time_reported', 'urgency_level',
									'reporter', 'email'));
 
            $response = array();
            $issue_name = $app->request->post('issue_name');
 			$description = $app->request->post('description');
 			$location_name = $app->request->post('location_name');
			$latitude = $app->request->post('latitude');
			$longitude = $app->request->post('longitude');
			$image_path = $app->request->post('image_path');
 			$date_reported = $app->request->post('date_reported');
 			$time_reported = $app->request->post('time_reported');
 			$urgency_level = $app->request->post('urgency_level');
 			$reporter = $app->request->post('reporter');
			$email = $app->request->post('email');
			$mobile = $app->request->post('mobile');

            //global $user_id;
            $db = new DbHandler();
 
            // creating new task
            $issue_id = $db->createIssue($issue_name, $description, $location_name,
            							$latitude, $longitude, $image_path,
            							$date_reported, $time_reported, $urgency_level,
										$reporter, $email, $mobile);
 
            if ($issue_id != NULL) {
                $response["error"] = false;
                $response["message"] = "Issue created successfully";
                $response["issue_id"] = $issue_id;
            } else {
                $response["error"] = true;
                $response["message"] = "Failed to create task. Please try again";
            }
            echoResponse(201, $response);
        });
        
		

/**
 * Listing all issues
 * method GET
 * url /issue          
 */
$app->get('/issue', 'authenticate', function() {

            $response = array();
            $db = new DbHandler();
 
            // fetching all user tasks
            $result = $db->getAllIssue();
 
            $response["error"] = false;
            $response["issue"] = array();
 
            // looping through result and preparing tasks array
            while ($issue = $result->fetch_assoc()) {
                $tmp = array();
                $tmp["id"] = $issue["id"];
                $tmp["issue_name"] = $issue["issue_name"];
                $tmp["description"] = $issue["description"];
                $tmp["location_name"] = $issue["location_name"];
				$tmp["latitude"] = $issue["latitude"];
				$tmp["longitude"] = $issue["longitude"];
				$tmp["image_path"] = $issue["image_path"];
				$tmp["date_reported"] = $issue["date_reported"];
				$tmp["time_reported"] = $issue["time_reported"];
				$tmp["urgency_level"] = $issue["urgency_level"];
				$tmp["status"] = $issue["status"];
                $tmp["status_comment"] = $issue["status_comment"];
                
                array_push($response["issue"], $tmp);
            }

            echoResponse(200, $response);
        });

/**
 * Listing single issue
 * method GET
 * url /issue/:id
 * Will return 404 if the issue doesn't exists
 */
$app->get('/issue/:id', 'authenticate', function($issue_id) {
            global $user_id;
            $response = array();
            $db = new DbHandler();
 
            // fetch task
            $result = $db->getIssue($issue_id);
 
            if ($result != NULL) {
                $response["error"] = false;
                $response["id"] = $result["id"];
                $response["issue_name"] = $result["issue_name"];
				$response["description"] = $result["description"];
				$response["location_name"] = $result["location_name"];
				$response["latitude"] = $result["latitude"];
				$response["longitude"] = $result["longitude"];
				$response["image_path"] = $result["image_path"];
				$response["date_reported"] = $result["date_reported"];
				$response["time_reported"] = $result["time_reported"];
				$response["urgency_level"] = $result["urgency_level"];
				$response["reporter_name"] = $result["reporter_name"];
				$response["email"] = $result["email"];
				$response["mobile"] = $result["mobile"];
                $response["status"] = $result["status"];
				$response["status_comment"] = $result["status_comment"];
                
                echoResponse(200, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });
		
/**
 * Updating existing issue
 * method PUT
 * params status, status_comment
 * url - /issue/:id
 */
$app->put('/issue/:id', 'authenticate', function($issue_id) use($app) {
            // check for required params
            verifyRequiredParams(array('status'));
 
            global $user_id;            
            $status = $app->request->put('status');
            $status_comment = $app->request->put('status_comment');
			 
            $db = new DbHandler();
            $response = array();
 
            // updating task
            $result = $db->updateIssue($issue_id, $status, $status_comment);
            if ($result) {
                // issue updated successfully
                $response["error"] = false;
                $response["message"] = "Issue updated successfully";
            } else {
                // task failed to update
                $response["error"] = true;
                $response["message"] = "Issue failed to update. Please try again!";
            }
            echoResponse(200, $response);
        });
				
$app->run();
?>