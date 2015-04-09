<?php
 
/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Lim Xing Yi
 */
class DbHandler {
 
    private $conn;
 
    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
 
    /* ------------- `users` table method ------------------ */
 
    /**
     * Creating new user
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function createUser($name, $email, $password) {
        require_once 'PassHash.php';
        $response = array();
 
        // First check if user already existed in db
        if (!$this->isUserExists($email)) {
            // Generating password hash
            $password_hash = PassHash::hash($password);
 
            // Generating API key
            $api_key = $this->generateApiKey();
 
            // insert query
            $stmt = $this->conn->prepare("INSERT INTO user(name, email, password_hash, api_key, status) values(?, ?, ?, ?, 1)");
            $stmt->bind_param("ssss", $name, $email, $password_hash, $api_key);
 
            $result = $stmt->execute();
 
            $stmt->close();
 
            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                return USER_CREATED_SUCCESSFULLY;
            } else {
                // Failed to create user
                return USER_CREATE_FAILED;
            }
        } else {
            // User with same email already existed in the db
            return USER_ALREADY_EXISTED;
        }
 
        return $response;
    }
 
    /**
     * Checking user login
     * @param String $email User login email id
     * @param String $password User login password
     * @return boolean User login status success/fail
     */
    public function checkLogin($email, $password) {
        // fetching user by email
        $stmt = $this->conn->prepare("SELECT password_hash FROM user WHERE platform = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->bind_result($password_hash);
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // Found user with the email
            // Now verify the password
 
            $stmt->fetch();
 
            $stmt->close();
 
            if (PassHash::check_password($password_hash, $password)) {
                // User password is correct
                return TRUE;
            } else {
                // user password is incorrect
                return FALSE;
            }
        } else {
            $stmt->close();
 
            // user not existed with the email
            return FALSE;
        }
    }
 
    /**
     * Checking for duplicate user by email address
     * @param String $email email to check in db
     * @return boolean
     */
    private function isUserExists($email) {
        $stmt = $this->conn->prepare("SELECT id from user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
 
    /**
     * Fetching user by email
     * @param String $email User email id
     */
    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT name, email, api_key, status, created_at FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
 
    /**
     * Fetching user api key
     * @param String $user_id user id primary key in user table
     */
    public function getApiKeyById($user_id) {
        $stmt = $this->conn->prepare("SELECT api_key FROM user WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $api_key = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $api_key;
        } else {
            return NULL;
        }
    }
 
    /**
     * Fetching user id by api key
     * @param String $api_key user api key
     */
    public function getUserId($api_key) {
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE api_key = ?");
        $stmt->bind_param("s", $api_key);
        if ($stmt->execute()) {
            $user_id = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user_id;
        } else {
            return NULL;
        }
    }
 
    /**
     * Validating user api key
     * If the api key is there in db, it is a valid key
     * @param String $api_key user api key
     * @return boolean
     */
    public function isValidApiKey($api_key) {
        $stmt = $this->conn->prepare("SELECT id from user WHERE api_key = ?");
        $stmt->bind_param("s", $api_key);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
 
    /**
     * Generating random Unique MD5 String for user Api key
     */
    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }
 
    /* ------------- `issue` table method ------------------ */
 
    /**
     * Creating new issue
     * @param String $user_id user id
     * @param String $issue_name issue name
	 * @param String $description description of the issue
     */
    public function createIssue($issue_name, $description, $location_name, 
    							$latitude, $longitude, $image_path,
    							$date_reported, $time_reported, $urgency_level,
								$reporter_name, $email, $contact, $status) {
       
        $stmt = $this->conn->prepare("INSERT INTO issue(issue_name, 
        							description,
        							location_name,
        							latitude,
        							longitude,
        							image_path,
        							date_reported,
        							time_reported,
        							urgency_level,
        							reporter_name,
        							email,
        							contact,
									status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssddssssssss", $issue_name, $description, $location_name, 
        							$latitude, $longitude, $image_path,
        							$date_reported, $time_reported, $urgency_level,
        							$reporter_name, $email, $contact, $status);
        $result = $stmt->execute();
        $stmt->close();
 
        if ($result) {
            // new row created
            $new_issue_id = $this->conn->insert_id;
            
            // issue created successfully
            return $new_issue_id;

        } else {
            // issue failed to create
            return NULL;
        }
    }
 
    /**
     * Fetching single issue
     * @param Integer $issue_id id of the issue
     */
    public function getIssue($issue_id) {
        $stmt = $this->conn->prepare("SELECT * from issue WHERE id = ?");
        $stmt->bind_param("i", $issue_id);
        if ($stmt->execute()) {
            $issue = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $issue;
        } else {
            return NULL;
        }
    }
 
    /**
     * Fetching issue based on issue status
     * @param String $filter
     */
    public function getIssueByFilter($filter) {
        $stmt = $this->conn->prepare("SELECT * from issue WHERE status = ? ORDER BY id DESC");
        $stmt->bind_param("s", $filter);
        $stmt->execute();
        $issue = $stmt->get_result();
        $stmt->close();
        return $issue;
    }
	 
    /**
     * Fetching all issues
     */
    public function getAllIssue() {
        $stmt = $this->conn->prepare("SELECT * FROM issue ORDER BY id DESC");
        $stmt->execute();
        $issue = $stmt->get_result();
        $stmt->close();
        return $issue;
    }
 
    /**
     * Updating issue
     * @param Integer $issue_id id of the issue
     * @param String $status
     * @param String $status_comment
     */
    public function updateIssue($issue_id, $status, $status_comment) {
        $stmt = $this->conn->prepare("UPDATE issue set status = ?, status_comment = ? WHERE id = ?");
        $stmt->bind_param("ssi", $status, $status_comment, $issue_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows > 0;
    }
 
 
    /**
     * Deleting a issue
     * @param Integer $issue_id id of the issue to delete
	 * Currently not in use.
     */
     /*
    public function deleteIssue($issue_id) {
        $stmt = $this->conn->prepare("DELETE * FROM issue WHERE id = ?");
        $stmt->bind_param("i", $issue_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows > 0;
    }
	*/
}
 
?>