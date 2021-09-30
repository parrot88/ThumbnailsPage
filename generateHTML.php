<?php
require_once('./tag.tmp.php');
class GenerateHTML{
    public function disp($layerArr){
        $this->dispHeadTag();
        $this->dispImagesTag($layerArr['imgPathArr']);
        $this->dispDirectoryTag($layerArr['dirPathArr']);
        $this->dispFooterTag();
    }

    private function dispHeadTag(){
        echo TAG::hooterTag;
    }

    private function dispImagesTag($imgPathArr){
        $count = 0;
        foreach($imgPathArr as $key=>$path){
            echo TAG::ImgTagHead.$path.TAG::ImgTagFoot;
            $count++;
        }
    }

    private function dispDirectoryTag($dirPathArr){
        foreach($dirPathArr as $oneDirArr){
            echo TAG::DirLinkTagHead.$oneDirArr['path'].TAG::DirLinkTagMiddle.$oneDirArr['tilte'].TAG::DirLinkTagFoot;
        }
    }

    private function dispFooterTag(){
        echo TAG::FooterTag;
    }
}