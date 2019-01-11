<?php
define ('CONNECT_TIMEOUT', 5);
define ('READ_TIMEOUT', 15);

class HttpClient
{
    var $sock = 0;
    var $ssl;
    var $host;
    var $port;
    var $path;
    var $status;
    var $headers = "";
    var $body = "";
    var $reqeust;
    var $errorcode;
    var $errormsg;


    function test_fsockopen_url($url)
    {
        $errno = '';
        $errstr = '';

        $url_data = parse_url($url);
        if ($url_data["scheme"] == "https") {
            $this->ssl = "ssl://";
            $this->port = 443;
        }

        $this->host = $url_data["host"];
        $this->path = $url_data["path"];

        if (!$this->sock = fsockopen($this->ssl . $this->host,
            $this->port, $errno, $errstr, CONNECT_TIMEOUT)) {

            switch ($errno) {
                case -3:
                    $this->errormsg = 'Socket creation failed (-3)';
                case -4:
                    $this->errormsg = 'DNS lookup failure (-4)';
                case -5:
                    $this->errormsg = 'Connection refused or timed out (-5)';
                default:
                    $this->errormsg = 'Connection failed (' . $errno . ')';
                    $this->errormsg .= ' ' . $errstr;
            }
            return '<font color=red>'.$this->errormsg.'</font>';
        } else {
            return '<font color=blue>성공</font>';
        }
    }
}

$hc = new HttpClient();

echo 'fsockopen() Test Page<br>';

$authUrl = 'https://fcstdpay.inicis.com/api/payAuth';
$netCancelUrl = 'https://fcstdpay.inicis.com/api/netCancel';
$checkAckUrl = 'https://fcstdpay.inicis.com/api/checkAck';

echo '$authUrl : ' . $hc->test_fsockopen_url($authUrl) . '<br>';
echo '$netCancelUrl : ' . $hc->test_fsockopen_url($netCancelUrl) . '<br>';
echo '$checkAckUrl : ' . $hc->test_fsockopen_url($checkAckUrl) . '<br>';
echo 'iniweb : ' . $hc->test_fsockopen_url('https://iniweb.inicis.com') . '<br>';
?>