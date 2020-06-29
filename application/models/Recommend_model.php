<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Recommend_model extends CI_Model
{
    ## config/autoload.php -> $autoload['libraries'] = array('database');
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    public function get_board()
    {
        $sql = "CREATE TABLE IF NOT EXISTS recommend_board_20172838(
            id INT NOT NULL AUTO_INCREMENT,
            title VARCHAR(50) NOT NULL,
            content TEXT NOT NULL,
            nickname VARCHAR(8) NOT NULL,
            saveTime datetime NOT NULL DEFAULT NOW(),
            hit INT NOT NULL,
            contentText TEXT,
            PRIMARY KEY(id)
            );";
        $this->db->query($sql);

        // 
        // $this->db->query($sql);

        $sql = "SELECT id, title, nickname, saveTime, hit, contentText FROM recommend_board_20172838 ORDER BY id DESC;";
        return $this->db->query($sql);
    }
    public function insert_post($data)
    {
        $title = $data['title'];
        $content = $data['content'];
        $nickname = $data['nickname'];
        $contentText = $data['contentText'];

        $sql = "INSERT INTO recommend_board_20172838(title, content, nickname, saveTime, hit, contentText) VALUES('$title', '$content', '$nickname', NOW(), 0, '$contentText')";
        $this->db->query($sql);

        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_post($id)
    {
        $hitUpdateSql = "UPDATE recommend_board_20172838 SET hit = hit + 1 WHERE id='$id'";
        $this->db->query($hitUpdateSql);
        if ($this->db->affected_rows() > 0) {
            $sql = "SELECT id, title, nickname, saveTime, content FROM recommend_board_20172838 WHERE id='$id'";
            return $this->db->query($sql);
        } else
            return false;
    }
    public function rewrite_post($id)
    {
        $sql = "SELECT id, title, content, saveTime FROM recommend_board_20172838 WHERE id=$id";
        return $this->db->query($sql);
    }
    public function post_update($data, $id)
    {
        $title = $data['title'];
        $content = $data['content'];
        $contentText = $data['contentText'];

        $sql = "UPDATE recommend_board_20172838 SET title = '$title', content = '$content', contentText = '$contentText' WHERE id='$id'";
        $this->db->query($sql);

        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function post_delete($id)
    {
        $sql = "DELETE FROM recommend_board_20172838 WHERE id='$id'";
        return $this->db->query($sql);
    }
}
