<?php
class Core_Model_DbTable_Users extends Zend_Db_Table
{
    protected $_name = 'users';
    /**
    * Get list of users
    */
    public function getUsers()
    {
        $select = $this->select();
        $data = $this->fetchAll($select);
        return $data;
    }
}
?>