<?php
class ControllerToolTest extends Controller {
	public function index() {
        $dirs = [];
        $dirs[] = DIR_APPLICATION.'simplepars/cache_page/';
        $dirs[] = DIR_APPLICATION.'simplepars/cookie/';
        $dirs[] = DIR_APPLICATION.'simplepars/replace/';
        $dirs[] = DIR_APPLICATION.'simplepars/xml_page/';
        $dirs[] = DIR_APPLICATION.'simplepars/scripts';
        $dirs[] = DIR_APPLICATION.'uploads/';
        $dirs[] = DIR_IMAGE.'catalog/SPshow/';
        foreach($dirs as $dir){
            if(!is_dir($dir)){ mkdir($dir, 0777, true); }
        }
    }
}