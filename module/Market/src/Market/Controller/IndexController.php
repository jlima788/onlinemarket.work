<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Market\Controller\ListingsTableTrait;

class IndexController extends AbstractActionController
{
    use ListingsTableTrait;
    
    public function indexAction()
    {
        $messages = array('Welcome to the Online Market');
        if($this->flashMessenger()->hasMessages()){
            $messages = $this->flashMessenger()->getMessages();
        }
     
        $itemRecent = $this->listingsTable->getLatestListing();
        
        //return array('messages'=>$messages);
        return new ViewModel(array('messages'=>$messages,'item'=>$itemRecent));
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
