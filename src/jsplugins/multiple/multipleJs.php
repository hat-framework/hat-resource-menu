<?php

use classes\Classes\JsPlugin;
class multipleJs extends JsPlugin implements jsmenu{

    public function init() {
        $this->LoadJsPlugin('menu/menu', 'menu');
        $this->menu->imprime();
    }
    
    static private $instance;
    public static function getInstanceOf($plugin){
        $class_name = __CLASS__;
        if (!isset(self::$instance))self::$instance = new $class_name($plugin);
        return self::$instance;
    }
    
    public function draw($menu, $class = "menu", $id = ''){
        if(!is_array($menu))return false;
        $this->title = ($this->title == "")?"":"<h3 id='menu_title'>$this->title</h3>";
        $var  = "$this->title <div class='$class' $id>";
        $var .=     $this->menu->draw($menu, $class = "menu", $id = '');
        $var .= "</div>";
        $this->title = "";
        if($this->imprimir) echo $var;
        else return $var;
    }
    
    private $title = "";
    public function addTitle($title){
        $this->title = $title;
    }
    
    private $imprimir = true;
    public function imprime() {
        $this->imprimir = false;
        $this->menu->imprime();
    }

}

?>