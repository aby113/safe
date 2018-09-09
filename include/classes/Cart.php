<?php
class Cart{

    private $con;
    
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function getCart($mno){
        $sql = "
                SELECT c.*, p.p_name, p.p_price, p.p_url, (p.p_price * c.amount) AS totalCnt FROM cart c, product p, member m
                WHERE c.pno = p.pno
                AND c.mno = m.mno
                AND c.mno = ?
               ";

        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($mno));
        return $stmt->fetchAll();
    }


    public function getPrePare($sql):PDOStatement
    {
        return $this->con->prepare($sql);
    }


}
?>