<?php


function analaysis($cert){

    $data2=openssl_x509_parse( openssl_x509_read($cert));
    //I get information from data2(data2 is array)

    echo "hostname: ".$data2["subject"]["CN"]."\n";
    echo $data2["issuer"]["O"];
    echo "\n"."Valid From time: ".date('Y-m-d H:i:s',$data2['validFrom_time_t']);
    echo "\n"."Valid To time: ".date('Y-m-d H:i:s',$data2['validTo_time_t']);;

// You could check end of SSL date
    if (date("Y-m-d H:i:s") <= date('Y-m-d H:i:s',$data2['validTo_time_t'])){
        echo "\n"."Not expired";
    }else{
        echo "Expired";
    }

}

//this line can read pem file.
$fp = fopen('asimmisirli-com.pem','r');
$cert = fread($fp,8192);
fclose($fp);
analaysis($cert);









