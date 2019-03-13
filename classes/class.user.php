<?php
include('class.password.php');
class User extends Password{
    private $db;
	function __construct($db){
		parent::__construct();
		$this->_db = $db;
	}
	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}
	private function get_user_hash($username){
		try {
			$result = $this->_db->query('SELECT memberID, username, password FROM blog_members WHERE `username` = "'.$username.'"') or die($this->_db->error);
			return $result->fetch_assoc();
		} catch(Exception $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}
	public function login($username,$password){
		$user = $this->get_user_hash($username);
		if($this->password_verify($password,$user['password']) == 1){
		    $_SESSION['loggedin'] = true;
		    $_SESSION['memberID'] = $user['memberID'];
		    $_SESSION['username'] = $user['username'];
		    return true;
		}
	}
	public function logout(){
		session_destroy();
	}
}
?>