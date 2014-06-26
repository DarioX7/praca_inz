<?php

class Application_Model_DbTable_DbTemp extends Zend_Db_Table_Abstract
{

    protected $_name = 'temperatura';
    protected $_primary = 'id_temp';
    
    
    
    //pobranie dla ostatnio dodanej wartości w "Pokój"
    public function getLastPokoj(){
        return $this->getAdapter()->query("SELECT * FROM temperatura WHERE id_temp = (select MAX(id_temp) from temperatura where nr_seryjny = '28E8622D050000DC')")->fetchObject();  
    }
    //TODO
    /*
     * getLastGaraz()
     * getLastSalon()
     * getLastLazienka()
     * getLastKuchnia
     * 
     */
    
}

