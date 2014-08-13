<?php

use classes\Classes\JsPlugin;
class accordionJs extends JsPlugin implements jsmenu{

    public function init() {
        $this->LoadJsPlugin('menu/menu', "menu");
        $this->menu->imprime();
    }
    
    static private $instance;
    public static function getInstanceOf($plugin){
        $class_name = __CLASS__;
        if (!isset(self::$instance))self::$instance = new $class_name($plugin);
        return self::$instance;
    }
    
    public function draw($menu, $class = "", $id = ''){

         if(!is_array($menu))return;
         $this->Scripts();
         
         $var  =  ("<div class='menu accordion $class'>");
         $var .=     $this->menu->draw($menu, '', $id);
         $var .=  ("</div>");
         if($this->imprimir) echo $var;
         else {
             $this->imprimir = true;
             return $var;
         }
    }
    
    private $imprimir = true;
    public function imprime() {
        $this->imprimir = false;
    }

    private function Scripts(){
        $this->Html->LoadJQuery();
        $this->Html->LoadJs("$this->url/scripts/accordion");
        if(!DISABLE_EXTERN_CSS){
            $this->Html->LoadExternCss("$this->url/scripts/accordion");
            $this->Html->LoadCss("menu");
        }
    }
}

?>