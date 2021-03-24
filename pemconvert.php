<?php


function getInformation($file)
{
    $sslDate = "";
    //this line convert pem file to array
    $data2 = openssl_x509_parse(openssl_x509_read($file));
    

    //this line check subjectAltname
    if (is_null($data2["extensions"]["subjectAltName"]) ==false){
        
        $subjectAltname = $data2["extensions"]["subjectAltName"];
    }
    else{
        
        $subjectAltname = "No subjectAltName";
    }
    
    //I get information from data2(data2 is array)


    if (date("Y-m-d H:i:s") <= date('Y-m-d H:i:s', $data2['validTo_time_t'])) {
        //echo "\n"."Not expired";
        $sslDate = "SSL Not expired" . " Valid To time: " . date('Y-m-d H:i:s', $data2['validTo_time_t']);

    } else {
        $sslDate = "SSL Expired" . " Valid To time: " . date('Y-m-d H:i:s', $data2['validTo_time_t']);

    }
    $device_data = array(

        "host" => $data2["subject"]["CN"],
        "certificateChain" => [

            "subject" => $data2["issuer"]["O"],
            "expired" => $sslDate
        ],
        "subjectAltName" => $subjectAltname

    );
    return $device_data;


}

//You should read file name instead of asimmisirli-com.pem
$fp = fopen('asimmisirli-com.pem','r');
$file = fread($fp,8192);
fclose($fp);
getInformation($file);


$result =getInformation($file);
print_r($result);
