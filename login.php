<?php
/*$postid=$_POST['id'];
$postpw=$_POST['pw'];
$c= new PDO('mysql:host=localhost;dbname=secu','user','password');
st=$c->query("SELECT name FROM users WHERE id=:id");
$stmt->bindValue(":id",$postid);
$st=excute();

$result=$st->fetch();
if($postid==$result['id']&&$postpw==$result['pw']) header("Location:/gugu.php");
else header("Location:/login.html");*/

$ID = $_POST['id'];
$PW = $_POST['pw'];

$dbHost = "localhost";
$dbName = "Users";
$dbUser = "user";
$dbPass = "password";

try {
    // 서버잉름, 데이터베이스이름, 사용자명, 비밀번호를 전달 새로운 PDO 객체를 생성 
    $db = new PDO("mysql:host ={$dbHost}; dbname = {$dbName}", $dbUser, $dbPass);
    $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDO 객체에 에러모드 설정, 에러 발생될때마다 PDOException 으로 던짐

    //$keyword = "%테스트%";
    //$no = 1;

    // 쿼리 바료 실행 방법 $변수 = $pdo-> query(쿼리);
    //$query = "SELECT lid,profile, uid, upw, joindate from Users.Users "; //이런식으로 하면 sql 인젝션을 막을 수 있다
    //$stmt = $db -> prepare($query); // 쿼리 준비 
    //$stmt -> execute(array($keyword, $no)); execute() 준비된 쿼리 실행
    //bindValue 는 값을 직접 대입
    //bindParam 은 변수를 대입 
    //$stmt -> execute(); 준비된 쿼리 실행
    //PDOStatement:fetch() 한번 실행하면 쿼리 결과를 한 행을 가져온다.
    //예 $row = $stmt -> fetch(PDO::FETCH_ASSOC); 
    //$result = $stmt->fetchALL(PDO::FETCH_NUM); // PDOStatement:fetchAll() 
    // PDOStatement::fetchColumn() 결과값 중 하나의 컬럼만 가져오는 메소드 
    // 데이터베이스를 PDO로 불러오고 쿼리를 준비해서 stmt 객체를 생성 하고 파라미터값(:이름)을 bind 값이랑 변수랑 정해주고 execute 실행해주는 듯?
    
    // 입력 받은 ID가 데이터 베이스에 존재하는지 확인하고 
    // 있으면 비밀번호 확인 후 비밀번호가 맞으면 통과 
    $query = "SELECT uid from Users.Users";
    $stmt = $db -> prepare($query);
    $stmt -> execute();
    $corID = $stmt -> fetchColumn();
    if ($ID == $corID)
    {
    

    $query = "SELECT upw from Users.Users WHERE uid = :uid";
    $stmt = $db -> prepare($query);
    $stmt -> bindValue(":uid", $ID);
    $stmt -> execute();
    
    //$row = $stmt -> fetch();
    //echo "<pre>";
    //print_r($row);
    //echo "</pre>";
    $corpw = $stmt -> fetchColumn();

    if($corpw == $PW)
    {
        require("/var/www/html/secu_task_web3/secu999.php");

    }else{
        $html = file_get_contents('http://34.64.45.196/mylittlewebserver/Secu_Web_task_2.html');
        echo "" . $html;
    }
}else{
    header('Location: http://34.64.45.196/mylittlewebserver/Secu_Web_task_2.html');
    
}

    } catch(PDOException $e)
    {
        echo $e -> getMessage();
    }



?>