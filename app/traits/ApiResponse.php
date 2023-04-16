<?php

namespace App\traits;

trait ApiResponse
{
    public function apiResponse($data=null,$message=null,$status=null){
        $response=[
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
        return response($response,$status);
    }

    public function apiError($errors=null,$status=404){
        $response=[
            'errors'=>$errors,
            'status'=>$status,
        ];
        return response($response,$status);
    }
}
