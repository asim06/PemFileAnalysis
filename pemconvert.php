<?php


function analaysis($cert){

    $data2=openssl_x509_parse( openssl_x509_read($cert));
    //When we converted. Data2 will be array.
    //if you want look all text in pem file. you should  write this line.  print_r($data2);
    echo "hostname: ".$data2["subject"]["CN"]."\n";
    echo $data2["issuer"]["O"];
    echo "\n"."Valid From time: ".date('Y-m-d H:i:s',$data2['validFrom_time_t']);
    echo "\n"."Valid To time: ".date('Y-m-d H:i:s',$data2['validTo_time_t']);;

// This line could check end of SSL date
    if (date("Y-m-d H:i:s") <= date('Y-m-d H:i:s',$data2['validTo_time_t'])){
        echo "\n"."Not expired";
    }else{
        echo "Expired";
    }

}

//this line could read pem file
$fp = fopen('asimmisirli-com.pem','r');
$cert = fread($fp,8192);
fclose($fp);
analaysis($cert);









