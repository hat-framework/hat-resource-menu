<?php

use classes\Classes\JsPlugin;
class menuJs extends JsPlugin implements jsmenu{

    private $ids = array();
    private $print = true;
    private $level = 0;
    public function init(){
        if(!DISABLE_EXTERN_CSS)$this->Html->LoadCss("menu");
    }
    
    private $liclass = "";
    public function setLiClass($class){
        $this->liclass = $class;
    }
    
    static private $instance;
    public static function getInstanceOf($plugin){
        $class_name = __CLASS__;
        if (!isset(self::$instance))self::$instance = new $class_name($plugin);
        return self::$instance;
    }

    public function imprime(){
        $this->print = false;
    }
    
    public function draw($menu, $class = "menu", $id = ""){
        $this->level = 0;
        static $i = 0; $i++;
        $id = ($id == "") ? "menu_$i" : "$id";
        $var = "";
        //desenhando o menu
        if(!empty($menu)){
            $var  = "<ul class='$class ' id='$id'>";
            $var .= $this->drawMenu($menu);
            $var .= "</ul>";
        }
        if($this->print == true) echo $var;
        else $this->print = true;
        $this->level = 0;
        return $var;
    }
    
    public function drawMenu($menu){
        
        //validação do menu
        if(!is_array($menu)) {return "";}
        
        //inicializa as variaveis
        $var = "";
        $this->level++;
        $color_type = "color$this->level";
        foreach($menu as $name => $array){

            //seta as variaveis
            $id      = $this->getId($name, $array);
            $link    = $this->getLink($name, $array);
            $current = ($link == CURRENT_URL);
            $class   = ($current)?"current_page":"";

            //carrega o link a ser colocado no menu
            $protected_link = $this->Html->getActionLinkIfHasPermission($link, $name, $color_type, "a_$id");
            
            //se link é vazio, então usuário não tem permissão de acessá-lo
            if($protected_link == "") {continue;}
            if($current) $protected_link = $this->Html->getActionLinkIfHasPermission("#", $name, "$color_type active", "a_$id");
            
            //gera o html do menu e concatena
            $var .= $this->geraMenu($array, $link, $id, "$class $color_type", $protected_link);
            
        }
        $this->level--;
        return $var;
    }
    
    private function getId($name, &$array){
        if(is_array($array) && array_key_exists('__id', $array)){
            $id = GetPlainName($array['__id']);
            unset($array['__id']);
        }else $id = GetPlainName($name);
        return $id;
    }
    
    private function getLink($name, &$array){
        $link = "#";
        if(is_array($array)){
            if(array_key_exists($name, $array)){
                $link = $array[$name];
                unset($array[$name]);
            }
        }else $link = $array;
        return $link;
    }
    
    private function geraMenu($array, $link, $id, $class, $protected_link){

        $concat = "";
        
        //se menu possui subitens, desenha o menu dos subitens
        if(is_array($array) && !empty($array)){
            $temp = $this->drawMenu($array);
            if($temp != "") $concat = "<ul>$temp</ul>"; 
            elseif($protected_link == "")$concat = "";
        }

        //se menu não possui subitens e o link está vazio
        elseif($protected_link == "") $concat = "";

        $list = "";
        
        //verifica se a variável temporária está vazia
        if($concat != "" || $link != "")  $list  = "<li id='$id' class='$this->liclass $class'> $protected_link $concat </li>";
        elseif($link == "#") $list  = "";
        return $list;
    }
}

?>