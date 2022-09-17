<?php

class View
{
    private $page;

    public function __construct()
    {
        $this->page = $this->searchHTML('header');
        $this->page .= $this->searchHTML('nav');
    }
        
    public function displayHome()
    {
        $this->page .= "<h1>Vous pouvez trouver vos missions du jour <a href='#'>ici</a> </h1>";
        $this->display();
    }
    public function displayList($list)
    {
        $this->page .= "<h1></h1>";
        
        $tableau = '<div class="container">'
        . '<table class="table table-striped table-bordered" cellspacing="0">'
        . '<thead>'
        . '<th>Nom</th><th>Prenom</th><th>Password</th><th>Metier</th><th>Email</th><th>Modification</th><th>Suppression</th>'
        . '</thead><tbody>';
        
        foreach ($list as $ligne) {
            $tableau .= "<tr><td>$ligne[1]</td>"
        ."<td>$ligne[2]</td>"
        ."<td>$ligne[3]</td>"
        ."<td>$ligne[4]</td>"
        ."<td>$ligne[5]</td>"
        ."<td><a href='admin-ouvriers.php?
        action=update&parm0=$ligne[0]&parm1=$ligne[1]&parm2=$ligne[2]&parm3=$ligne[3]&parm4=$ligne[4]&parm5=$ligne[5]'><span class='glyphicon
        glyphicon-pencil'></span></a></td>"
        ."<td><a href='admin-ouvriers.php?action=delete&parm0=$ligne[0]&parm1=$ligne[1]&parm2=$ligne[2]&parm3=$ligne[3]&parm4=$ligne[4]&parm5=$ligne[5]'><span class='glyphicon
        glyphicon-remove'></span></a></td></tr>";
        }

        $tableau .= "</tbody></table></div>";
        $this->page .= $tableau;
        $this->display();
    }

    private function displayForm($paramaters)
    {
        $this->page .= $this->searchHTML('form');
        $this->page = str_replace("{readonly}", $paramaters["readonly"], $this->page);
        $this->page = str_replace("{parm0}", $paramaters["parm0"], $this->page);
        $this->page = str_replace("{parm1}", $paramaters["parm1"], $this->page);
        $this->page = str_replace("{parm2}", $paramaters["parm2"], $this->page);
        $this->page = str_replace("{parm3}", $paramaters["parm3"], $this->page);
        $this->page = str_replace("{parm4}", $paramaters["parm4"], $this->page);
        $this->page = str_replace("{parm5}", $paramaters["parm5"], $this->page);
        $this->page = str_replace("{action}", $paramaters["action"], $this->page);
        $this->page = str_replace("{lib_action}", $paramaters["lib_action"], $this->page);
        $this->display();
    }
    public function displayAdd()
    {
        $this->page .= "<h1></h1>";
        $paramaters = array(
        "readonly"=>"",
        "parm0"=>"",
        "parm1"=>"",
        "parm2"=>"",
        "parm3"=>"",
        "parm4"=>"",
        "parm5"=>"",
        "action"=>"add",
        "lib_action"=>"Ajout");
        $this->displayForm($paramaters);
    }
        
    public function displayUpdate($paramGet)
    {
        $this->page .= "<h1></h1>";
        $paramaters = array(
        "readonly"=>"",
        "parm0"=>$paramGet['parm0'],
        "parm1"=>$paramGet['parm1'],
        "parm2"=>$paramGet['parm2'],
        "parm3"=>$paramGet['parm3'],
        "parm4"=>$paramGet['parm4'],
        "parm5"=>$paramGet['parm5'],
        "action"=>"update",
        "lib_action"=>"Modifier");
        $this->displayForm($paramaters);
    }
        
    public function displayDelete($paramGet)
    {
        $this->page .= "<h1></h1>";
        $paramaters = array(
        "readonly"=>"readonly",
        "parm0"=>$paramGet['parm0'],
        "parm1"=>$paramGet['parm1'],
        "parm2"=>$paramGet['parm2'],
        "parm3"=>$paramGet['parm3'],
        "parm4"=>$paramGet['parm4'],
        "parm5"=>$paramGet['parm5'],
        "action"=>"delete",
        "lib_action"=>"Supprimer");
        $this->displayForm($paramaters);
    }
        
        
    public function display()
    {
        $this->page .= $this->searchHTML('footer');
        echo $this->page;
    }
        
    private function searchHTML($filename)
    {
        $content = file_get_contents('partials/'.$filename.'.php');
        return $content;
    }
}