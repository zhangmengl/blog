<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
    
    //文件上传  
    function upload($filename){
        //接收文件
        $file=request()->$filename;
        //判断文件在上传过程中是否出错
        if($file->isValid()){
            //接收并上传文件
            $path = $file->store('uploads');
            return $path;
        }
        exit("未获取到上传文件或上传过程出错");
    }
        
    //多文件上传  
    function MoreUpload($filename){
        //接收文件
        $file=request()->$filename;
        //循环接收的文件
        foreach($file as $k=>$v){
            //判断文件在上传过程中是否出错
            if($v->isValid()){
                //接收并上传文件
                $path[$k] = $v->store('uploads');
            }else{
                $path[$k] = "未获取到上传文件或上传过程出错";
            }
        }
        return $path;
    }