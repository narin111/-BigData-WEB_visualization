<?php

	$OPENURL = "https://db.itkc.or.kr/people/view?gubun=person&cate1=Z&cate2=&dataId=";
	$current = 100;
	$dataId = sprintf("P%06d", $current);
	$OPENURL = $OPENURL."$dataId";


	$ch = curl_init();								// curl 초기화
	curl_setopt($ch, CURLOPT_URL, $OPENURL);			// URL 지정
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// 요청 결과를 문자열로 반환
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);	// set timeout
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 원격 서버의 인증서 유효성 검사 안함
	$response = curl_exec($ch);
	$response = str_replace("textarea", "text_area", $response);

	
?>
<textarea cols="100" rows="20">
	<?php echo $response ?>
</textarea>

