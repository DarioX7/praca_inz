<?php

class AutoryzacjaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */        
    }

    public function indexAction()
    {
        // action body
        $this->view->form = new Application_Form_Logowanie();
    }

    public function logowanieAction()
    {
        // action body
        //$this->view->tytul = 'Logowanie';
        $this->_helper->viewRenderer('index');
        $form = new Application_Form_Logowanie();
        if ($form->isValid($this->getRequest()->getPost())) {

            $adapter = new Zend_Auth_Adapter_DbTable(
                null,
                'uzytkownik',
                'username',
                'password'
            );

            $adapter->setIdentity($form->getValue('username'));
            $adapter->setCredential($form->getValue('password'));

            $auth = Zend_Auth::getInstance();

            $result = $auth->authenticate($adapter);

            if ($result->isValid()) {
                return $this->_helper->redirector(
                    'index',
                    'index',
                    'default'
                );
            }
            $form->password->addError('Błędna próba logowania!');
        }
        $this->view->form = $form;
    }

    public function wylogowanieAction()
    {
        // action body
        //$this->view->tytul = 'Wylogowanie';
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->_helper->redirector(
            'autoryzacja',
            'index',
            'default'
        );
        
        $this->_helper->viewRenderer('index');
    }


}





