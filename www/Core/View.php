<?php 

namespace App\Core;
class View
{
    private String $templateName;
    private String $viewName;

    public function __construct(string $viewName, string $templateName = "back")
    {
        $this->setViewName($viewName);
        $this->setTemplateName($templateName);
    }

    /**
     * Set the value of t cv emplateName
     *
     * @return  self
     */ 
    public function setTemplateName($templateName): void
    {
        if(!file_exists("Views/Templates/".$templateName.".tpl.php"))
        {
            die("Le template Views/Templates/".$templatename.".tpl.php n'existe pas ");
        }
        $this->templateName = "Views/Templates/".$templateName. ".tpl.php";

    }

    /**
     * Set the value of viewName
     *
     * @return  self
     */ 
    public function setViewName($viewName)
    {
        if(!file_exists("Views/".$viewName.".view.php"))
        {
            die("La vue Views/".$viewName.".view.php n'existe pas");
        }
        $this->viewName = "Views/".$viewName.".view.php";

    }

    public function __destruct()
    {
        include $this->templateName;
    }
}