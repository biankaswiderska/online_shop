<?php
require_once __DIR__ . '/../conn.php';
namespace OShop;

class Review {
    private $id;
    private $authorId;
    private $productId;
    private $text;
    private $rating;
    
    public function __construct() {
        $this->id = '';
        $this->authorId = '';
        $this->text = '';
        $this->productId = '';
        $this->rating = '';
    }
    
    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Reviews(authorId, productId, text, rating) '
                    . 'VALUES (:authorId, :productId, :text, :rating)');
            
            $result = $stmt->execute([ 
                'authorId' => $this->authorId, 
                'productId' => $this->productId,
                'text'=> $this->text, 
                'rating' => $this->rating]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            
        } else {
            $stmt = $conn->prepare('UPDATE Reviews'
                    . 'SET authorId=:authorId, '
                    . 'productId = :productId, '
                    . 'text=:text, '
                    . 'rating=:rating '
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'authorId' => $this->authorId, 
                'productId' => $this->productId,
                'text' => $this->text,
                'rating' => $this->rating,
                'id' => $this->id]);
            return $result;
        }
        return false;
    }
    
    static public function loadReviewById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Reviews WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedReview = new Review();
            $loadedReview->id = $row['id'];
            $loadedReview->setAuthorId($row['authorId']);
            $loadedReview->setProductId($row['productId']);
            $loadedReview->setText($row['text']);
            $loadedReview->setRating($row['rating']);
            return $loadedReview;
        }
    }
    
    static public function loadReviewByProductId(PDO $conn, $productId) {
        $stmt = $conn->prepare('SELECT * FROM Reviews WHERE productId=:productId');
        $result = $stmt->execute(['productId' => $productId]);
        $ret = [];
        
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedReview = new Review();
                $loadedReview->id = $row['id'];
                $loadedReview->setAuthorId($row['authorId']);
                $loadedReview->setProductId($row['productId']);
                $loadedReview->setText($row['text']);
                $loadedReview->setRating($row['rating']);
                $ret[] = $loadedReview;
            }
        }
        return $ret;
    }
    
    static public function loadReviewByAuthorId(PDO $conn, $authorId) {
        $stmt = $conn->prepare('SELECT * FROM Reviews WHERE authorId=:authorId');
        $result = $stmt->execute(['authorId' => $authorId]);
        $ret = [];
        
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedReview = new Review();
                $loadedReview->id = $row['id'];
                $loadedReview->setAuthorId($row['authorId']);
                $loadedReview->setProductId($row['productId']);
                $loadedReview->setText($row['text']);
                $loadedReview->setRating($row['rating']);
                $ret[] = $loadedReview;
            }
        }
        return $ret;
    }
    
    function getId() {
        return $this->id;
    }

    function getAuthorId() {
        return $this->authorId;
    }

    function getText() {
        return $this->text;
    }

    function getRating() {
        return $this->rating;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAuthorId($authorId) {
        $this->authorId = $authorId;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setRating($rating) {
        $this->rating = $rating;
    }
    function getProductId() {
        return $this->productId;
    }

    function setProductId($productId) {
        $this->productId = $productId;
    }


    
    
    
    
    
}