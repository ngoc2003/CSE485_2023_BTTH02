<?php
class Articles {
	private $id;
    private $postTable = 'cms_posts';
    private $categoryTable = 'cms_category';
    private $userTable = 'cms_user';
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getArticles() {
        $query = '';

        if ($this->id) {
            $query = " AND p.id ='".$this->id."'";
        }

        $sqlQuery = "SELECT p.id, p.title, p.message, p.category_id, u.first_name, u.last_name, p.status, p.created, p.updated, c.name as category FROM ".$this->postTable." p
            LEFT JOIN ".$this->categoryTable." c ON c.id = p.category_id
            LEFT JOIN ".$this->userTable." u ON u.id = p.userid
            WHERE p.status ='published' $query ORDER BY p.id DESC";

        $result = $this->conn->query($sqlQuery);

        if (!$result) {
            die("Error in query: " . $this->conn->error);
        }

        return $result;
    }
}