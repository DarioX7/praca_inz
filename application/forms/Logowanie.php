<?php

class Application_Form_Logowanie extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $view = Zend_Layout::getMvcInstance()->getView();
        $url = $view->url(array(
            'controller' => 'autoryzacja',
            'action' => 'logowanie',
        ));

        $this->setAction($url);
        
        $this->addDecorators(array(  
            'FormElements',  
            array('HtmlTag', 
                array(
                    'tag' => 'div', 
//                    'class' => 'formularz', 
                    'id' => 'html_tag')),  
            array('Form',
                array(
//                    'class' => 'zend_form', 
                    'id' => 'formularz'))
        ));  

//------------------------------------------------------------------------------        
        
        $username = new Zend_Form_Element_Text(
                'username',
                array('placeholder' => 'Login',
                    'required' => true,
                    'filters'  => array('StringTrim', 'StringToLower'))
                );
        
        $username->addDecorator(
                'HtmlTag',
                array('tag' => 'div',
                    'class' => 'formularz',
                    'id' => 'username')
                );
        
        $username->addDecorator(
                'Label',
                array('tag' => 'div',)
                );

        
        $this->addElement($username);

//------------------------------------------------------------------------------        
        $password = new Zend_Form_Element_Password(
                'password',
                array('placeholder' => 'Hasło'));

        $password->addDecorator(
                'HtmlTag',
                array('tag' => 'div',
                    'class' => 'formularz',
                    'id' => 'password')
                );
        
        $password->addDecorator(
                'Label',
                array('tag' => 'div')
                );
                
        $this->addElement($password);
        
//------------------------------------------------------------------------------
        
        $submit = new Zend_Form_Element_Submit(
                'submit',
                array('label' => 'Zaloguj'));
        
        $submit->setDecorators(
                array(
                    'ViewHelper',
                    'Description',
                    'Errors', 
                    array(
                        array('data'=>'HtmlTag'),
                        array('tag' => 'div',
                            'class' => 'formularz',
                            'id'=>'zaloguj')
                        )
                    )
                );
        
        $this->addElement($submit);
        
    }


}

