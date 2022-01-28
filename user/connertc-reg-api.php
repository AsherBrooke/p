<?php
$url_api = 'https://api.worachote.com/api/gift/v1/';
$burl = 'http://localhost/';//base url 
$hzurl = 'http://localhost/';//ตัวนี้ url สำหรับ redireact ไปที่เดิม
$in_burl_refresh = '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=' . $hzurl . '">';
$data_header = array(
  'Token: HAehfuihuiaheuitfghuiosehauiofhiouasjouihufhioeajuioje9ijiojiotj9iquioweaj0if',
);
$data_body = array(
  'username' => $_POST['username'],
  'password' => $_POST['password'],
  'repassword' => $_POST['repassword'],
);
$data_postfields = http_build_uqery($data_body);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_api);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_postfields);
curl_setopt($ch, CURLOPT_HTTPHEADER, $data_header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
$response = json_decode($data, true);

print_r($response);
 ?>