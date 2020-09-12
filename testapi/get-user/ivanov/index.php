<?php
$status = "OK";
$message = "";

if(!empty($_GET['token'])) {
	$token = htmlspecialchars($_GET['token']);

    
    if ($token === 'dsfd79843r32d1d3dx23d32d') {
        $response = array(
            "status" => $status,
            "active" => "1",
            "blocked" => false,
            "created at" => 1587457590,
            "id" => 23,
            "name" => "Ivanov Ivan",
            "permissions" => array(
                array(
                    "id" => 1,
                    "permission" => "comment"
                ),
                array(
                    "id" => 2,
                    "permission" => "upload photo"
                ),
                array(
                    "id" => 3,
                    "permission" => "add event"
                )
            )
        );
    } else {
        $status = "Not found";
    }
}
else {
    $status = "Error";
}


if ($status == "OK") {
    echo json_encode( $response );
} else {
    $response = array(
        "status" => $status
    );
    echo json_encode( $response );
}
  

?>
