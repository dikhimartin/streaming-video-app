<?php
namespace App\Traits;

trait RespondsWithHttpStatus
{
 
    protected function ok($data, $message, $statusCode = 200){
        $status = array(
            'code' => $statusCode,
            'message' => ($message=="") ? "OK" : $message,
        );
        return response([
            'status' => $status,
            'data' => $data,
        ], $statusCode);
    } 
    
    protected function created($data, $message, $statusCode = 201){
        $status = array(
            'code' => $statusCode,
            'message' => ($message=="") ? "Created" : $message,
        );
        return response([
            'status' => $status,
            'data' => $data,
        ], $statusCode);
    }

    protected function deleted($message, $statusCode = 200){
        $status = array(
            'code' => $statusCode,
            'message' => ($message=="") ? "Data deleted successfully" : $message,
        );
        return response([
            'status' => $status,
        ], $statusCode);
    } 

    protected function unauthorized($message, $statusCode = 401){
        $status = array(
            'code' => $statusCode,
            'message' => ($message=="") ? "Unauthorized" : $message,
        );
        return response([
            'status' => $status,
        ], $statusCode);
    } 
    
    protected function errorNotFound($message, $statusCode = 404){
        $status = array(
            'code' => $statusCode,
            'message' => ($message=="") ? "Not Found" : $message,
        );
        return response([
            'status' => $status,
        ], $statusCode);
    }

    protected function errorInternal($message, $statusCode = 500){
        $status = array(
            'code' => $statusCode,
            'message' => ($message=="") ? "Internal Server Error" : $message,
        );
        return response([
            'status' => $status,
        ], $statusCode);
    }

}