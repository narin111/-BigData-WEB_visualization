<?php
	date_default_timezone_set("Asia/Seoul");
	include "db.inc.php";
    include "register_globals.php";
	$conn = connectDB();
	register_globals();
    
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
<!-- 부트스트랩 grid 이용하기 -->
<body>

   <div class="container">

    <?php
        if(isset($counter))
            $counter = $counter+1;
        else
            $counter = 1;
    ?>
        <script>
            setTimeout( function() {
                // 페이지 이동 (현재 페이지 새로고침)
                location.href='<?php echo $PHP_SELF?>?counter=<?php echo $counter?>';
            }, 3000); //3000ms 마다 새로고침 하겠다.
        </script> 

    </div>
</body>
</html>

<?php
    closeDB($conn);
?>