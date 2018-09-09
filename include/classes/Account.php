<?php

class Account{

    private $con;
    private $errorArr;


    public function __construct($con){
        $this->con = $con;
        $this->errorArr = array();
    }

    public function getError($error) {
        if(!in_array($error, $this->errorArr)) {
            $error = "";
        }
        return "<p><span class='errorMessage'>$error</span></p>";
    }

    public function register($memArr){
        $this->validateId($memArr[6]);
        $this->validateEmail($memArr[2]);
        $this->validatePw($memArr[0], $memArr[1]);
        
        if(empty($this->errorArr)){
            // pw2를 자른다, pw1을 암호화 비밀번호로 대체한다.
            array_splice($memArr, 1, 1);
            array_splice($memArr, 0, 1, md5($memArr[0])); 
          return $this->insertMember($memArr);
        }

        return false;
    }

    public function login($id, $pw):bool
    {
        $pw = md5($pw);
        $sql = "SELECT * FROM member WHERE id=? AND pw=?";
        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($id, $pw));
        if($stmt->rowCount()){
            $_SESSION["login"] = $stmt->fetch();
            return true;
        }

        array_push($this->errorArr, Constants::$loginFailed);
        return false;
    }


    public function insertMember($memArr):bool
    {
        
       $sql = "
        INSERT INTO member
        (pw, 
        email, 
        ph, 
        hp, 
        address, 
        id, 
        regdate, 
        post_cd, 
        addr_sub)
         VALUES
         (
            ?,
            ?,
           ?,
            ?,
            ?,
            ?,
            now(),
            ?,
            ?
        )";
       
        try {
            $stmt = $this->getPrePare($sql);
            $stmt->bindValue(1, $memArr[0], PDO::PARAM_STR);
            $stmt->bindValue(2, $memArr[1], PDO::PARAM_STR);
            $stmt->bindValue(3, $memArr[2], PDO::PARAM_INT);
            $stmt->bindValue(4, $memArr[3], PDO::PARAM_INT);
            $stmt->bindValue(5, $memArr[4], PDO::PARAM_STR);
            $stmt->bindValue(6, $memArr[5], PDO::PARAM_STR);
            $stmt->bindValue(7, $memArr[6], PDO::PARAM_STR);
            $stmt->bindValue(8, $memArr[7], PDO::PARAM_STR);
            return $stmt->execute($memArr);
        }catch(Exception $e){
            print $e->getMessage();
        }
    }

    // 아이디 유효성 검사
    public function validateId($id){
        if(strlen($id) < 3){
            array_push($this->errorArr, Constants::$idCharacters);
            return;
        }

        if($this->isAccount($id)){
            array_push($this->errorArr, Constants::$idTaken);
            return;
        }
    }

    // 비밀번호 유효성 검사
    public function validatePw($pw1, $pw2){

        if($pw1 !== $pw2){
            array_push($this->errorArr, Constants::$passwordsDoNoMatch);
            return;
        }

        if(strlen($pw1) > 30 || strlen($pw1) < 5) {
            array_push($this->errorArr, Constants::$passwordCharacters);
            return;
        }

    }

    // 이메일 유효성 검사
    public function validateEmail($email){

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArr, Constants::$emailInvalid);
        }

        if($this->isEmail($email)){
            array_push($this->errorArr, Constants::$emailTaken);
        }
    }


    // 계정이 존재하는지 알려주는 함수
    public function isAccount($id):bool{
       $sql = "SELECT mno FROM member WHERE id=?";
       $stmt = $this->getPrePare($sql);
       $stmt->execute(array($id));
       return $stmt->fetch()? true:false;
    }

    // 이메일이 존재여부 리턴
    public function isEmail($email):bool{
        $sql = "SELECT mno FROM member WHERE email=?";
        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($email));
        return $stmt->fetch()? true:false;
    }

    private function getPrePare($sql):PDOStatement
    {
        return $this->con->prepare($sql);
    }

}
?>