<?php

use classes\Classes\JsPlugin;
class dropdownJs extends JsPlugin implements jsmenu{

    public function init() {
        $this->LoadJsPlugin("menu/menu", "menu");
        $this->menu->imprime();
    }
    
    static private $instance;
    public static function getInstanceOf($plugin){
        $class_name = __CLASS__;
        if (!isset(self::$instance))self::$instance = new $class_name($plugin);
        return self::$instance;
    }
    
    private $imprimir = true;
    public function imprime() {
        $this->imprimir = false;
        $this->menu->imprime();
    }
    
    public function reset(){
        $this->imprimir = true;
    }
    
    public function draw($menu, $class = "", $id = 'menu-dropdown'){

        $this->menu->imprime();
        if(!is_array($menu)){return false;}
        $this->Scripts();
        $var = $this->menu->draw($menu, "dropdown $class", $id);
        if(!$this->imprimir) { return $var;}
        echo $var;

    }

    private function Scripts(){
        $this->Html->LoadJquery();
        //$this->Html->LoadJs("$this->url/scripts/dropdown");
        //$this->Html->LoadExternCss("$this->url/scripts/dropdown");
    }

}
