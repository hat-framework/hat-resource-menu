<?php

use classes\Classes\JsPlugin;
class treeviewJs extends JsPlugin implements jsmenu{

    public function init() {
        $this->LoadJsPlugin('menu/menu', 'menu');
        $this->menu->imprime();
        $this->js();
    }
    
    static private $instance;
    public static function getInstanceOf($plugin){
        $class_name = __CLASS__;
        if (!isset(self::$instance))self::$instance = new $class_name($plugin);
        return self::$instance;
    }
    
    private $ulclass = 'menu';
    public function setUlClass(){
        $this->ulclass = '';
    }
    
    public function setLiClass($liclass){
        $this->menu->setLiClass($liclass);
    }
    
    public function draw($menu, $class = "menu", $id = ""){

        //desenhando o menu
        $class = ($class == "")? "treeview":"$class treeview";
        $var  = "<div class='$class' $id>";
        $var .= $this->menu->draw($menu, $this->ulclass, $id = '');
        $var .= "</div>";
        if($this->print == true) echo $var;
        else return $var;
    }
    
    public function imprime(){
        $this->print = false;
        $this->menu->imprime();
    }
    
    public function js(){
        $this->Html->LoadJs("$this->url/cookie", true);
        $this->Html->LoadJs("$this->url/treeview", true);
        $this->Html->loadCss("plugins/menu/treeview");
        $this->Html->LoadJqueryFunction(
        '$(".treeview ul").treeview({
		animated: "fast",
		collapsed: false,
		unique: true,
		persist: "cookie"
	});');
    }
}

?>
