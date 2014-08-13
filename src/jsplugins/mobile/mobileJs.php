<?php

use classes\Classes\JsPlugin;
class mobileJs extends JsPlugin{

    static private $instance;
    public static function getInstanceOf($plugin){
        $class_name = __CLASS__;
        if (!isset(self::$instance))self::$instance = new $class_name($plugin);
        return self::$instance;
    }
    
    public function init() {
        $this->Scripts();
    }
    
    public function execute(){
        
    }

    private function Scripts(){
        $this->Html->LoadJquery();
        $this->Html->LoadJs("$this->url/js/jquery.mobile-1.0rc2.min");
        $this->Html->LoadJs("$this->url/js/app");
        
        $this->Html->LoadExternCss("css/jquery.mobile-1.0rc2.min.css");
    }

}

?>
