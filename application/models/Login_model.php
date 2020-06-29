<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
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
            nickcname VARCHAR(16) NOT NULL,
            userPassword VARCHAR(500) NOT NULL,
            birthday VARCHAR(10) NOT NULL,
            gender VARCHAR(4) NOT NULL,
            userPhoto VARCHAR(500),
            PRIMARY KEY(userEmail)
            );";
        $this->db->query($sql);
    }
    public function login($id, $pw)
    {
        $sql = "SELECT userPassword FROM users_20172838 WHERE userEmail = '$id';";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $hash_password = $row->userPassword;
            $pwResult = password_verify($pw, $hash_password);

            if ($pwResult) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function getNickName($id)
    {
        $query = $this->db->get_where('users_20172838', array('userEmail' => $id));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return false;
        }
    }
}
