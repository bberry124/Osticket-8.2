<?php
$target_host = $_GET['host'];

/* our simple php ping function */
function ping($host)
{
	if($host=="") return false;
//        exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);

        //exec(sprintf('ping %s', escapeshellarg($host)), $res, $rval);

        exec(sprintf('/bin/ping -c 3 %s', escapeshellarg($host)), $res, $rval);
        return $rval === 0;
}

$data = array();
$data['result'] = ping($target_host) ? 'live':'down';
header('Content-Type: application/json');
echo json_encode($data);
?>