<?php

use classes\Classes\JsPlugin;
class linkJs extends JsPlugin implements jsmenu{

    public function init(){
        $this->menu->imprime();
    }
    
    static private $instance;
    public static function getInstanceOf($plugin){
        $class_name = __CLASS__;
        if (!isset(self::$instance)) self::$instance = new $class_name($plugin);
        return self::$instance;
    }
    
    public function draw($menu, $class = "menu", $id = ""){
        $id = ($id == "") ? "" : "id='$id'";
        $var = "<div class='$class' $id>";
        $var .= $this->drawMenu($menu);
        $var .= "</div>";
        if($this->imprimir) echo $var;
        else return $var;
    }
    
    public function drawMenu($menu){
        if(!is_array($menu)) return;
        $var = "";
        foreach($menu as $name => $item){
              $id = strtolower(str_replace(" ", "-", $name));
              $link = $id . "/";
              $var .= $this->Html->MakeLink($link, $name, "", false);
        }
        return $var;
    }
    
    private $imprimir = true;
    public function imprime() {
        $this->imprimir = false;
        $this->menu->imprime();
    }

}

?>