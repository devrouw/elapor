<?php
if($type_query === "show"){
    $hasil = mysqli_query($con,$query);
    if (mysqli_num_rows($hasil) > 0) {
     while ($data = mysqli_fetch_assoc($hasil))
     {
        $response["code"] = 200;
        $response["status"] = "OK";
        $response['data'][] = $data;
        $response['message'] = $message;

     }
     echo json_encode($response);
     }
     else {
         $response["code"] = 404;
         $response["status"] = "error";
         $response["data"] = null;
         $response["message"] = "show error";

         echo json_encode($response);
     }
    }

     
else if ($type_query === "input"){
        $hasil = mysqli_multi_query($con,$query);
        if($hasil){
            $response["code"] = 200;
            $response["status"] = "OK";
            $response["data"] = "data berhasil diinput.";
            $response["message"] = $message;
            echo json_encode($response);
        }else
        {
            $response["code"] = 404;
            $response["status"] = "error";
            $response["data"] = "";
            $response["message"] = "input error $message";
            
            echo json_encode($response);

        }
     }

     else if ($type_query === "input_imei"){
        $hasil = mysqli_multi_query($con,$query);
        if($hasil){
            $response["code"] = 200;
            $response["status"] = "OK";
            $response["data"] = "data berhasil diinput.";
            $response["message"] = $message;
            echo json_encode($response);
        }else
        {
            $response["code"] = 404;
            $response["status"] = "404";
            $response["data"] = null;
            $response["message"] = "input error $message";
            
            echo json_encode($response);

        }
     }

else if ($type_query === "edit"){
        $hasil = mysqli_multi_query($con,$query);
        if($hasil){
            $response["code"] = 200;
            $response["status"] = "OK";
            $response["data"] = "data berhasil diedit.";
            $response["message"] = $message;
            echo json_encode($response);
        }else
        {
            $response["code"] = 404;
            $response["status"] = "error";
            $response["data"] = "";
            $response["message"] = "edit error";

            echo json_encode($response);

        }
     }

else if ($type_query === "update"){
        $hasil = mysqli_multi_query($con,$query);
        if($hasil){
            $response["code"] = 200;
            $response["status"] = "OK";
            $response["data"] = "data berhasil diupdate.";
            $response["message"] = $message;
            echo json_encode($response);
        }else
        {
            $response["code"] = 404;
            $response["status"] = "error";
            $response["data"] = "";
            $response["message"] = "update error";

            echo json_encode($response);

        }
     }
else {
    if ($message === null){
        $message = 'show error!';
    }else{
        $message = $message;
    }
    $response["code"] = 404;
    $response["status"] = "error";
    $response["data"] = "";
    $response["message"] = $message;

    echo json_encode($response);
}

     ?>

