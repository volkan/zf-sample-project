<?php
/**
 * @author 
 */
class Model_DbTable_Word
    extends Zend_Db_Table_Abstract 
{
	/**
	 * The default table name 
	 */
	protected $_name = 'words';
	protected $_primary = 'id';
    
    /**
     * Zend'in sql oluşturma metodları kullanılarak sql oluşturup
     * araya istediğimiz kadar join vs.. yapabiliyoruz 
     * @return array 
     */
    function zendDbSql()
    {
        
        $select = $this->_db->select()
                ->from('words','words.*');
        $select->joinLeft('deneme', 'deneme.id=words.id');
        $select->joinLeft('deneme', 'deneme.id=words.id');
        return $this->_db->query($select)->fetchAll();
    }
    
    /**
     * Veya Sql kodumuzu doğrudan kendimiz yazabiliyoruz.
     * Güvenlik önlemi olarak parametreleriayrı yolluyoruz.
     * @return type 
     */
    function ozelSql()
    {
        
        $query = 'SELECT * FROM words WHERE id = ?';
        
        return $this->_db->query($query,array(1))->fetchAll();
    }    

}