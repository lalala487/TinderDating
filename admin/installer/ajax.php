<?php

if (isset($_GET["direct"])) {

    $data = [];
    $baseurl = $_POST['name'];
    $jsondata = curlsingle_request($data, $baseurl);

    echo json_encode($jsondata);
    exit();
} else {

    $servername =  $_POST['hostname'];
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $database =  $_POST['database'];

    $conn = @mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {

        echo json_encode("no");

    }else{
        echo json_encode("yes");
    }

}


function curlsingle_request($data, $baseurl)
{
    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json"
    );
    $ch = curl_init($baseurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $return = curl_exec($ch);
    $json_data = json_decode($return, true);
    curl_close($ch);
    return $json_data;
}
