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
       <div class="row rowLine">
           <div class="col"></div>
       </div>

       <div class="row rowLine">
           <!-- 한 화면에 몇 칸을 차지할건지 합이 12이 되어야함 -->
           <div class="col-6 bg-primary text-white">6</div>
           <div class="col-4 bg-danger">4</div>
           <div class="col-2 bg-success">2</div>
       </div>

       <div class="row rowLine">
           <!-- 지정하지 않는다면 균등분할 -->
           <div class="col bg-primary text-white">6</div>
           <div class="col bg-danger">4</div>
           <div class="col bg-success">2</div>
       </div>

       <div class="row rowLine">
           <!-- 하나만 지정, 나머지는 균등 -->
           <div class="col-6 bg-primary text-white">6</div>
           <div class="col bg-danger">4</div>
           <div class="col bg-success">2</div>
       </div>

       <div class="row rowLine">
           <!-- 화면의 비율에 따라 분할  xs, sm, md, lg, xlg, xxlg-->
           <div class="col-6 col-md-3 bg-primary text-white">6</div>
           <div class="col-4 col-lg-5 bg-danger">4</div>
           <div class="col-2 bg-success">2</div>
       </div>

       <div class="row rowLine">
           <div class="col">사용자 입력 테스트</div>
       </div>

       <div class="row rowLine">
           <div class="col-2">password</div>
           <div class="col">
               <!-- form-contorl은 나머지 영역에 대해서 가장 최적화 -->
               <input type="password" name="pass" class="form-control">
           </div>
       </div>

       <div class="row rowLine">
           <div class="col-2">select</div>
            <div class="col">
                <select name="local" class="form-control">
                    <option value="">+===선택==+</option>
                    <option value="1">서울</option>
                    <option value="2">충청</option>
                    <option value="3">경기</option>
                    <option value="4">기타</option>
                </select>
            </div>
        </div>

        <div class="row rowLine">
           <div class="col-2">textarea</div>
            <div class="col">
                <!-- textarea 기본크기 10으로 -->
                <textarea name="memo" class="form-control" rows="10">1111</textarea>
            </div>
        </div>

        <div class="row rowLine">
            <div class="col-2">
                <button type="submit" class="btn btn-primary">실행</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-danger btn-sm">danger</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-success form-control"> <span class="material-icons">settings</span> success</button>
            </div>
        </div>

   </div>
</div>
</body>
</html>

<?php
    closeDB($conn);
?>