<?php
	date_default_timezone_set("Asia/Seoul");

	include "db.inc.php";
    include "register_globals.php";

	$conn = connectDB();
	register_globals();

    // http://localhost/02.php


?>

<!doctype html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<title>전북대 데이터 시각화</title>
		<meta name="viewport"
			content="width=device-width, maximum-scale=3.0, user-scalable=yes">
		<link href="style.css" rel="stylesheet" type="text/css"> 
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

	</head>
<body>
    <div class="container">

    bootstrap 용 기본 HTML 골격파일입니다. <br>

    <?php
        $i = 3;

        echo "$i <br>";

        // $i = "홍길동";
        // echo "$i <br>";

        // 출력 - echo
        // for($i=1; $i<=10; $i++)
        // {
        //     echo "$i<br>";
        // }

        /* fetch - 한줄씩 데이터 가져오는 것
            1   홍길동  10
            2   김개똥  20
            3   이순신  30

            // 연관배열
            $data["id"] = 1
            $data["name"] = "홍길동"
        */

        // 데이터베이스 연동
        //$sql = "select * from first_table ";
        // $sql = "select * from covid order by idx asc";
        // $result = mysqli_query($conn, $sql);
        // $data = mysqli_fetch_array($result);
        while($data)
        {   
            // 컴파일러는 "의 짝을 구분 못함 . 사용하기
            echo "id =". $data["name"]. "<br>";
            $data = mysqli_fetch_array($result);
        }


        $sql = "select * from covid order by idx asc";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

        // 순서, 타겟, 원인, 나이.....
    ?>
    
        <div class="row rowLine">
            <div class="col">순서</div>
            <div class="col">타겟</div>
            <div class="col">no</div>
            <div class="col">day</div>
            <div class="col">ages</div>
            <div class="col">area</div>
            <div class="col">source</div>
            <div class="col">status</div>
        </div>

    <?php

        while($data)
        {
           ?>
            <div class="row rowLine">
                <div class="col"><?php echo $data["idx"]?></div>
                <div class="col"><?php echo $data["target"]?></div>
                <div class="col"><?php echo $data["no"]?></div>
                <div class="col"><?php echo $data["day"]?></div>
                <div class="col"><?php echo $data["ages"]?></div>
                <div class="col"><?php echo $data["area"]?></div>
                <div class="col"><?php echo $data["source"]?></div>
                <div class="col"><?php echo $data["status"]?></div>
            </div>
           <?php
            $data = mysqli_fetch_array($result);
        }


    ?>

    </div>  <!-- container -->
</body>
</html>

<?php
    closeDB($conn);
?>