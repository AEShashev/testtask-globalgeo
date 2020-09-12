<?php
$status = "OK";
$message = "";
$url = $_SERVER["REQUEST_URI"];
$token =  parse_url($url);
$token = parse_str($token['query'], $query);
$token = $query['token'];
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);

// var_dump($_SERVER['REQUEST_METHOD']);
// echo $token;
if(!empty($token)) {
	$token = htmlspecialchars($token);
 
    if ($token === 'dsfd79843r32d1d3dx23d32d') {

        $status = "OK";

    } else {
        $status = "Error 1";
    }
}
else {
    $status = "Error 2";
}


if ($status == "OK") {
    $response = array(
        "status" => $status
    );
    
} else {
    $response = array(
        "status" => $status,
        "message" => $message
    );
    
}
echo json_encode( $response );

?>
