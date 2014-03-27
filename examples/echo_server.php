<?php
$serv = new swoole_server("127.0.0.1", 9501);
$serv->set(array('worker_num' => 2));
$serv->on('timer', function($serv, $interval) {
	echo "onTimer: $interval\n";
});
$serv->on('workerStart', function($serv, $worker_id) {
	//if($worker_id == 0) $serv->addtimer(600);
});
$serv->on('connect', function ($serv, $fd){
    //echo "[#".posix_getpid()."]\tClient:Connect.\n";
});
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    //echo "[#".posix_getpid()."]\tClient[$fd]: $data\n";
    $serv->send($fd, "swoole: $data");
	//$serv->close($fd);
});
$serv->on('close', function ($serv, $fd) {
    //echo "[#".posix_getpid()."]\tClient: Close.\n";
});
$serv->start();

