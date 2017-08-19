<?php


namespace  AppBundle\Form\Handler;

use Doctrine\ORM\Query\Expr\Base;
use FOS\UserBundle\Form\RegisterHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

class RegisterHandler extends  BaseHandler
{
    public function process($confirmation = false){
        $user = $this->userManager->createUser();
        $this->form->setData($user);

        if('POST' == $this->request->getMethod()){
            $this->form->bind($this->request);

            if ($this->form->isValid()){
                return true;
            }
        }

        return false;

    }


    protected function onSuccess (UserInterface $user, $confirmation)
    {
        parent::onSuccess($user, $confirmation);
    }
}