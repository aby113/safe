<?php
 
 class Criteria {

    private $cno;
    private $perPageNum;
    private $order;
    private $sort;

    public function __construct()
    {
        
    }

    public function setSort($sort){
        if($sort == null){
            $this->sort = "DESC";
        }

    }
    

}
?>