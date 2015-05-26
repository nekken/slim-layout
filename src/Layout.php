<?php
namespace Nekken\Middleware;
class Layout extends \Slim\Middleware 
{
    protected $layoutScript;
    
    public function __construct($array = array())
    {
        if(isset($array['layoutScript']))
        {
            $this->setLayoutScript($array['layoutScript']);
        }
    }
    
    public function test()
    {
        return false;
    }
    
    public function call()
    {
        /* @var $view \Slim\View */
        
        $this->next->call();
        
        if($this->getLayoutScript())
        {
            $app  = $this->getApplication();
            $view = $app->view();
            $body = $app->response->getBody();
            
            $view->set("body", $body);
            $fullBody = $view->fetch($this->getLayoutScript(), $view->getData());
            $app->response->setBody($fullBody);
        }
    }
    
	/**
     * @return the $layoutScript
     */
    public function getLayoutScript ()
    {
        return $this->layoutScript;
    }

	/**
     * @param field_type $layoutScript
     */
    public function setLayoutScript ($layoutScript)
    {
        $this->layoutScript = $layoutScript;
        return $this;
    }

}
