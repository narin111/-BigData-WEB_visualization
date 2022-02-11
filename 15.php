<?php
	date_default_timezone_set("Asia/Seoul");

	// 기본설정값이 들어가는구나
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
		<!-- 모바일 환경 고려 모바일에서 3배까지만 확대하겠다(3.0, yes)-->
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

<?php 
    // if(isset($lat) and isset($lon))
    // {
    //     create table addr_table(
    //         idx int(10) auto_increment,
    //         address char(255),
    //         zipcode char(10),
    //         lat     char(20),
    //         lon     char(20),

    //         primary key(idx)
    //     );
    //     // addr_table - address, zip, lat, lon
    //     $sql = "insert into addr_table(address, zip, lat, lon) values ('$address', '$zipcode', '$lat', '$lon)";
    //     $result = mysqli_query($conn, $sql);
    // }
?>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=e8c7b60037aa6ef6177ca250d0292b99&libraries=services"> </script>

<script>

    //daum객체는 위에서 설정한 라이브러리 안쪽에 들어있다.
    function daumZipCode() {
        new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                if (data.userSelectedType === 'R') {  //R은 도로명 주소이다.
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    //fullAddr = data.jibunAddress; //도로명 주소가 아니라면.. 지번주소.
                    fullAddr = data.roadAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R' || data.userSelectedType==='J'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                } //도로명 주소일때는 법에 맞춰서 '동' 이름을 추가해야 한다.

                // 건물명이 있을 경우 추가한다.
                if(data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }

                // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                fullAddr += (extraAddr !== '' ?
                    ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                //5자리 새우편번호 사용

                document.getElementById('zipcode').value = data.zonecode;
                document.getElementById('road').value = fullAddr; //addr1에 확정된 주소값의 풀네임이 들어간다.

                // 커서를 상세주소 필드로 이동한다.
                // 커서를 이동시켜서 깜빡이게끔 한다.
                var geocoder = new daum.maps.services.Geocoder();
                var callback = function(result, status) {
                    var f = document.zipForm;

                    if(status == daum.maps.services.Status.OK)
                    {
                        document.getElementById('lon').value = result[0].x;
                        document.getElementById('lat').value = result[0].y;
                    }else
                    {
                        alert('Error Kakao Map API ...');
                    }
                };    


                var thisAddr = document.getElementById('road').value;
                geocoder.addressSearch(thisAddr, callback);


                document.getElementById('address').focus();


            }
        }).open();
    }
</script>



<form name=zipForm method=post action='<?php echo $PHP_SELF ?>' onSubmit="return checkError()">
<div class='row rowLine'>
    <div class='col-2 col-sm-2'>명칭</div>
        <div class='col-4 col-sm-4'>
            <button type='button' class='btn btn-info btn-sm' onClick=daumZipCode()>주소검색</button>
        </div>
        <div class='col-4 col-sm-4'>
            <input type='text' name='zipcode' id='zipcode'  class='form-control' readonly placeholder='우편번호'>
        </div>
    </div>

    <div class='row rowLine'>
        <div class='col-2 col-sm-2'>주소</div>
        <div class='col-10 col-sm-10'>
            <input type='text' name='road' id='road' class='form-control' readonly required placeholder='도로명주소(검색버튼으로 입력)'>
        </div>
    </div>

    <div class='row rowLine'>
        <div class='col-2 col-sm-2'>상세주소</div>
        <div class='col-10 col-sm-10'>
            <input type='text' name='address' id='address' class='form-control' placeholder='상세/추가 주소 입력'>
        </div>
    </div>
    <div class='row rowLine'>
        <div class='col-2 col-sm-2'>경도</div>
        <div class='col-4 col-sm-4'>
            <input type='text' name='lon' id="lon"  class='form-control'  placeholder='경도'>
        </div>
        <div class='col-2 col-sm-2'>위도</div>
        <div class='col-4 col-sm-4'>
            <input type='text' name='lat'  id="lat" class='form-control'  placeholder='위도'>
        </div>
        
    </div>
    <button onSubmit>저장하기</button>
</form><br><br>

</body>
</html>

<?php
    closeDB($conn);
?>