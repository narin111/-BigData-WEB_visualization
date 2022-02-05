<?php
	date_default_timezone_set("Asia/Seoul");

	include "db.inc.php";
    include "register_globals.php";

	$conn = connectDB();
	register_globals();

    // http://localhost/01.php


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

    <?php
        if(isset($mode) and $mode == "insert")
        {
            echo "name = $name , id = $id, age = $age <br>";

            $sql = "insert into mytable (id, name, age) values ('$id', '$name', '$age')";
            $result = mysqli_query($conn, $sql);
            if($result)
                $msg = "INSERT OK";
            else
                $msg = "INSERT FAIL";

            echo "
            <script>
                alert('$msg');
                location.href='$PHP_SELF';
            </script>
            ";

        }

        // 삭제
        if(isset($mode) and isset($idx) and $mode == "delete")
        {
            $sql = "DELETE FROM mytable WHERE idx='$idx' ";
            $result = mysqli_query($conn, $sql);
            if($result)
                $msg = "DELETE OK";
            else
                $msg = "DELETE FAIL";

            echo "
            <script>
                alert('$msg');
                location.href='$PHP_SELF';
            </script>
            ";
        }

        // 수정(갱신)
        if(isset($mode) and isset($idx) and $mode == "update")
        {
            $sql = "UPDATE mytable SET id='$id', name='$name', age='$age' WHERE idx='$idx' ";
            $result = mysqli_query($conn, $sql);
            if($result)
                $msg = "UPDATE OK";
            else
                $msg = "UPDATE FAIL";

            echo "
            <script>
                alert('$msg');
                location.href='$PHP_SELF';
            </script>
            ";
        }


    ?>



    DB Query 연습 <br>

    <form method="post" action="<?php echo $PHP_SELF ?>?mode=insert">
    <div class="row rowLine">
        <div class="col">아이디</div>
        <div class="col"><input type="text" name="id" class="form-control" placeholder="아이디" required></div>
        <div class="col">이름</div>
        <div class="col"><input type="text" name="name" class="form-control" placeholder="실명입력"  required></div>
    </div>

    <div class="row rowLine">
        <div class="col">나이</div>
        <div class="col"><input type="text" name="age" class="form-control" placeholder="나이"  required></div>
        <div class="col">
            <button type="submit" class="btn btn-primary">등록</button>
        </div>
    </div>

    </form>


    <?php

        //$sql = "select * from first_table ";
        $sql = "select * from mytable order by idx asc";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

        // 순서, 타겟, 원인, 나이.....
    ?>
    
        <script>
            function confirmDelete(pidx)
            {
                //alert(pidx); // 확인버튼만 존재
                if(confirm('정말 삭제하시겠습니까?'))
                {
                    location.href='<?php echo $PHP_SELF ?>?mode=delete&idx='+pidx;
                }else
                {
                    // 취소
                }
            }
        </script>


        <div class="row rowLine">
            <div class="col">순서</div>
            <div class="col">아이디</div>
            <div class="col">이름</div>
            <div class="col">나이</div>
            <div class="col">비고</div>
        </div>

    <?php

        while($data)
        {
            //http://localhost/03.php
           ?>
            <form method="post" action="<?php echo $PHP_SELF ?>?mode=update&idx=<?php echo  $data["idx"]?>">
                <div class="row rowLine">
                    <div class="col"><?php echo $data["idx"]?></div>
                    <div class="col">
                        <input type="text" name="id" class="form-control" value="<?php echo $data["id"]?>">
                    </div>
                    <div class="col">
                        <input type="text" name="name" class="form-control" value="<?php echo $data["name"]?>">
                    </div>
                    <div class="col">
                        <input type="text" name="age" class="form-control" value="<?php echo $data["age"]?>">
                    </div>
                
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm">수정</button>
                        <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete(<?php echo $data["idx"]?>)">삭제</button>

                    </div>
                </div>
            </form>
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