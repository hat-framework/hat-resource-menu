<?php

use classes\Classes\JsPlugin;
class dropdownJs extends JsPlugin implements jsmenu{

    public function init() {
        $this->LoadJsPlugin("menu/menu", "menu")->imprime();
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
        return $this;
    }
    
    public function reset(){
        $this->imprimir = true;
        return $this;
    }
    
    public function draw($menu, $class = "", $id = 'menu-dropdown'){
        if(!is_array($menu)){return false;}
        $this->Scripts();
        
        $var = $this->menu->imprime()
                ->setLiClass('dropdown')
                ->draw($menu, "dropdown nav navbar-nav $class", $id);
        if($this->imprimir) { echo $var;}
        $this->reset();
        return $var;

    }

    private function Scripts(){
        $this->Html->LoadJquery();
        //$this->Html->LoadJs("$this->url/scripts/dropdown");
        //$this->Html->LoadExternCss("$this->url/scripts/dropdown");
    }

}
