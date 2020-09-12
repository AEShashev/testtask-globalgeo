<?php
$status = "OK";
$message = "";

if(!empty($_GET['login']) && !empty($_GET['pass'])) {
	$login =htmlspecialchars($_GET['login']);
	$password=htmlspecialchars($_GET['pass']);
    
    if ($login === 'test' && $password === '12345') {
        $token = 'dsfd79843r32d1d3dx23d32d';
    } else {
        $status = "Not found";
    }
}
else {
    $status = "Error";
}


if ($status == "OK") {
    $response = array(
        "status" => $status,
        "token" => $token
    );
} else {
    $response = array(
        "status" => $status
    );
}
  echo json_encode( $response );

?>
