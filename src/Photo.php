<?php

class Photo {
    private $id;
    private $itemId;
    private $hrefArray;

    public function __construct($id = -1, $itemId = '', $hrefArray = []) {
        $this->setId($id);
        $this->setItemId($itemId);
        $this->setHrefArray($hrefArray);
    }

    
    
    function getId() {
        return $this->id;
    }

    function getItemId() {
        return $this->itemId;
    }

    function getHrefArray() {
        return $this->hrefArray;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setItemId($itemId) {
        $this->itemId = $itemId;
    }

    function setHrefArray($hrefArray) {
        $this->hrefArray = $hrefArray;
    }


}