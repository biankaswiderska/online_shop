<?php

class Address {
    private $id;
    private $street;
    private $streetno;
    private $localno;
    private $postcode;
    private $city;
    private $country;
    private $userId;

    function __construct($street, $streetno, $localno, $postcode, $city, $country, $userId, $id = -1) {
        if ($if == -1) {
            $this->setId(-1);
        }
        else {
            $this->setId($id);
        }
        $this->setStreet($street);
        $this->setStreetno($streetno);
        $this->setLocalno($localno);
        $this->setPostcode($postcode);
        $this->setCity($city);
        $this->setCountry($country);
        $this->userId($userId);
    }

    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Addresses(street, streetno, localno, postcode, city, country, userId) '
                    . 'VALUES (:street, :streetno, :localno, :postcode, :city, :country, :userId)');
            
            $result = $stmt->execute([ 
                'street' => $this->street, 
                'streetno'=> $this->streetno, 
                'localno' => $this->localno,
                'postcode' => $this->postcode,
                'city' => $this->city,
                'country' => $this->country,
                'userId' => $this->userId]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            
        } else {
            $stmt = $conn->prepare('UPDATE Addresses '
                    . 'SET street=:street, '
                    . 'streetno=:streetno, '
                    . 'localno=:localno, '
                    . 'postcode=:postcode, '
                    . 'city=:city'
                    . 'country=:country'
                    . 'userId=:userID'
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'street' => $this->street, 
                'streetno' => $this->streetno,
                'localno' => $this->localno,
                'postcode' => $this->postcode,
                'city' => $this->city,
                'country' => $this->country,
                'userId' => $this->userId]);
            
            return $result;
        }
        
        return false;
    }
    
    static public function loadAddressByUserId(PDO $conn, $userId) {
        $stmt = $conn->prepare('SELECT * FROM Addresses WHERE userId=:userId');
        $result = $stmt->execute(['userId' => $userId]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedAddress = new Address();
            $loadedAddress->id = $row['id'];
            $loadedAddress->setStreet($row['street']);
            $loadedAddress->setStreetno($row['streetno']);
            $loadedAddress->setLocalno($row['localno']);
            $loadedAddress->setPostcode($row['postcode']);
            $loadedAddress->setCity($row['city']);
            $loadedAddress->setCountry($row['country']);
            $loadedAddress->setUserId($row['userId']);
            return $loadedAddress;
        }
    }
        
        
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
        
    function getStreet() {
        return $this->street;
    }

    function getStreetno() {
        return $this->streetno;
    }

    function getLocalno() {
        return $this->localno;
    }

    function getPostcode() {
        return $this->postcode;
    }

    function getCity() {
        return $this->city;
    }

    function getCountry() {
        return $this->country;
    }

    function setStreet($street) {
        $this->street = $street;
    }

    function setStreetno($streetno) {
        $this->streetno = $streetno;
    }

    function setLocalno($localno) {
        $this->localno = $localno;
    }

    function setPostcode($postcode) {
        $this->postcode = $postcode;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setCountry($country) {
        $this->country = $country;
    }
    function getUserId() {
        return $this->userId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }



}
