<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Join_model extends CI_Model
{
    ## config/autoload.php -> $autoload['libraries'] = array('database');
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    public function set_users_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users_20172838(
            userEmail varchar(100) NOT NULL,
            nickname VARCHAR(16) NOT NULL,
            userPassword VARCHAR(500) NOT NULL,
            birthday VARCHAR(10) NOT NULL,
            gender VARCHAR(4) NOT NULL,
            userPhoto VARCHAR(500),
            PRIMARY KEY(userEmail)
            );";
        $this->db->query($sql);
    }
    public function getNickName($nickname)
    {
        $sql = "SELECT nickname FROM users_20172838 WHERE nickname = '$nickname'";
        $result = $this->db->query($sql);
        return $result;
    }
    public function getEmail($email)
    {
        $sql = "SELECT userEmail FROM users_20172838 WHERE userEmail='$email'";
        $result = $this->db->query($sql);
        return $result;
    }
    public function insertUserInfo($data)
    {
        $sql = $this->db->insert_string('users_20172838', $data);
        $this->db->query($sql);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function set_thumbnail($nickname, $userPhoto)
    {
        $sql = "UPDATE users_20172838 SET userPhoto = '$userPhoto' WHERE nickname = '$nickname'";
        $this->db->query($sql);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function get_profile_info($nickname)
    {
        $sql = "SELECT birthday, userPhoto, userEmail FROM users_20172838 WHERE nickname ='$nickname';";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $result = $result->row();
            return $result;
        } else {
            return false;
        }
    }
    public function updatePw($id, $pw)
    {
        $sql = "UPDATE users_20172838 SET userPassword = '$pw' WHERE userEmail = '$id'";
        $result = $this->db->query($sql);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
