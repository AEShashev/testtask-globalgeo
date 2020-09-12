<?php
require '../vendor/autoload.php';

class api
{
    public $login, $pass, $token, $base_uri,$param;
    function __construct($login, $pass,$base_uri)
    {
        $this->login = $login;
        $this->pass = $pass;
        try {

            $client  =  new  GuzzleHttp \ Client ([ 'base_uri'  =>  $base_uri ]); 
            $response = $client -> request('GET', '/testapi/auth?login='.$this->login.'&pass='.$this->pass);
            $obj = json_decode($response->getBody());

            if ($obj->{'status'} == 'OK') {

                $this->token = $obj->{'token'};

            } else {
                echo "Status:" . $obj->{'status'} . "<br>";
            }

        } catch (GuzzleHttp\Exception\ClientException $e) {

            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            print_r($responseBodyAsString);
        }
    }
     
    function getInfo()
    {   
        if ($this->token) {

            echo "Login: $this->login ; Pass: $this->pass <br>";
            echo "Token: $this->token ;<br>";

        } else {
            echo "Login error<br>";
        }
    }

    function getUser($user,$base_uri) 
    {   
        if ($this->token) {

            try {

                $client  =  new  GuzzleHttp \ Client ([ 'base_uri'  =>  $base_uri ]);
                $response = $client -> request('GET', '/testapi/get-user/'.$user.'?token='.$this->token);
                $obj = json_decode($response->getBody(),true);
                print("<pre>".print_r($obj,true)."</pre>");

            } catch (GuzzleHttp\Exception\ClientException $e) {

                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                print_r($responseBodyAsString);
            }

        } else {
            echo "Login error<br>";
        }
        
    }

    function setUser($user,$base_uri,$param) {
        if ($this->token) {

            try {

                $client  =  new  GuzzleHttp \ Client ([ 'base_uri'  =>  $base_uri ]);
                $response = $client -> post('/testapi/user/'.$user.'/update?token='.$this->token,['body' => json_encode($param)]);
                echo "JSON: " . json_encode($param)."<br>";
                $obj = json_decode($response->getBody());
                echo "RESULT:" .  $obj->{'status'} . "<br>";
            } 
            catch (GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                print_r($responseBodyAsString);
            } 
        } else {
            echo "Login error<br>";
        }
    }
}

$param = array(
    "active" => "1",
    "blocked" => true,
    "name" => "Petr Petrovich",
    "permissions" => array(
        array(
            "id" => 1,
            "permission" => "comment"
        )
    )
);
    

$obj = new api('test','12345','http://localhost');
echo $obj->getInfo();
echo $obj->getUser("Ivanov",'http://localhost');
echo $obj->setUser("Ivanov",'http://localhost',$param);

?>