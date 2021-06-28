<?php

class Item {

    var $item_id;
    var $item_name;
    var $qty;
    var $price;
    var $deleted = false;

    function get_item_cost() {
        return $this->qty * $this->price;
    }

    function delete_item() {
        $this->deleted = true;
    }

    function __construct($item_id, $item_name, $qty, $price) {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->qty = $qty;
        $this->price = $price;
    }

    function get_item_id() {
        return $this->item_id;
    }

    function get_item_name() {
        return $this->item_name;
    }

    function get_qty() {
        return $this->qty;
    }

    function get_price() {      
        return $this->price;
    }
  

}   

class Cart {

    var $items;
    var $depth;
    var Item $item;

    function __construct() {
        $this->items = array();
        $this->depth = 0;
    }

    function add_item($item) {
        $this->items[$this->depth] = $item;
        $this->depth++;
    }

    function delete_item($item_no) {
        $this->items[$item_no]->delete_item();
    }

    function get_depth() {
        return $this->depth;
    }

    function get_item($item_no) {
        return $this->items[$item_no];
    }
   
}
class test {
     public function newTest(){
          $this->bigTest();
          $this->smallTest();
     }

     private function bigTest(){
          //Big Test Here
     }

     private function smallTest(){
          //Small Test Here
     }

     public function scoreTest(){
          //Scoring code here;
     }
}



?>