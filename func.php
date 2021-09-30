<?php
require_once('./GenerateHTML.php');

class Func{
    private $path = '';             //指定パス
    private $checkDris = array();   //ディレクトリパス用配列

    //パスを指定して実行
    public function exec($path){
        $this->setPath($path);
        $layer1Arr = $this->getImageFileAndDirectory($path);
        //print_r($layer1Arr);
        $generateHTML = new GenerateHTML();
        $generateHTML->disp($layer1Arr);
    }

    public function setPath($path){
        $this->path = $path;
        //$this->checkDis[0] = $path;
    }

    //指定されたパス内の画像とディレクトリの配列を取得
    private function getImageFileAndDirectory($path){
        $dirPathArr = array();
        $imgArr = array();
        if(is_dir($path) && $handle = opendir($path)){
            while(($file = $this->checkDirectoryReadable($handle, $path)) !== false ){
                if( in_array ( $file, [ ".", ".." ] ) !== false )
                    continue;
                $thisPath = $path.'/'.$file;
                if(filetype($thisPath) === 'dir'){
                    $dirPathArr[] = ["tilte"=>$file, "path"=>$thisPath];
                }else if($this->checkImageFile($file)){
                    $imgPathArr[] = $this->fixIntoLocalHttpURL($thisPath);
                    $imgArr[$this->deleteImageStr($file)] = $this->fixIntoLocalHttpURL($thisPath);  //キーに画像の数字をいれておく
                }
            }
        }
        ksort($imgArr); //キーの画像の数字順に並び直し
        return array("imgPathArr"=>$imgArr,"dirPathArr"=>$dirPathArr);
    }

    //localで表示できるURLへ修正
    private function fixIntoLocalHttpURL($path){
        return str_replace('D:\htdocs\enn','http://localhost\enn',$path);
        //return $path;
    }

    //ディレクトリであること読み込めることをチェック
    private function checkDirectoryReadable($handle, $path){
        if(($file = readdir($handle)) === false )
            return false;
        return $file;
    }

    //画像ファイルかの判定
    private function checkImageFile($file){
        $imgArr = ['.jpg','.JPG','.png','PNG','webp','WEBP','gif','GIF'];
        foreach($imgArr as $searchStr){
            if(strpos($file,$searchStr))
                return true;
        }
        return false;
    }

    //画像拡張子削除
    private function deleteImageStr($file){
        $imgArr = ['.jpg','.JPG','.png','PNG','webp','WEBP','gif','GIF'];
        foreach($imgArr as $searchStr){
            if(strpos($file,$searchStr))
                return str_replace($searchStr,"",$file);
        }
        return '';
    }

}