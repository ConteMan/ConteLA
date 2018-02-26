<?php
if (!function_exists('writeLog')){
    function writeLog($dir, $data, $isDaily = false){
        if ($isDaily){
            $newFileName =  Carbon\Carbon::now()->toDateString() . '.log';
            $savePath = 'logs/' . $dir . '/' . $newFileName;
        } else {
            $savePath = 'logs/' . $dir . '.log';
        }
        $logFile = storage_path($savePath);
        $dir = File::dirname($logFile);
        if(!File::exists($dir)){
            File::makeDirectory($dir,0755,true);
        }
        if(is_array($data)||is_object($data)){
            $data = json_encode($data);
        }
        file_put_contents($logFile, '[' . Carbon\Carbon::now()->toDateTimeString() .'] ' . $data . PHP_EOL, FILE_APPEND);
    }
}