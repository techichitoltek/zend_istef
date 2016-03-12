<?php
/**
 * Outils de génération de models
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class GenerateController extends App_Backoffice_Controller
{
    /**
     * Overrides Zend_Controller_Action::init()
     *
     * @access public
     * @return void
     */
    public function init(){
        // init the parent
        parent::init();
    }

    /**
     * Index des models
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $cacheHandler = App_DI_Container::get('CacheManager')->getCache('default');
        // On vide totalement le cache à cause du cache de la base de données
        $cacheHandler->clean(Zend_Cache::CLEANING_MODE_ALL);

        $dbAdapter = Zend_Registry::get('dbAdapter');
        $listTableName = $dbAdapter->listTables();

        foreach ($listTableName as $tableName){
            $tableInfo = $dbAdapter->describeTable($tableName);
            $tableInfo = $dbAdapter->query("SHOW TABLE STATUS LIKE '".$tableName."'")->fetchObject();
            //$stmt = $dbAdapter->query("SHOW TABLE STATUS LIKE 'table_name';");
            //$tableStatus = $stmt->fetchObject();
            $listTables[$tableName] = $tableInfo;
        }

        $this->view->listTables = $listTables;
    }

    /**
     * Génération des models
     *
     * @access public
     * @return void
     */
    public function generateAction(){
        $cacheHandler = App_DI_Container::get('CacheManager')->getCache('default');
        // On vide totalement le cache à cause du cache de la base de données
        $cacheHandler->clean(Zend_Cache::CLEANING_MODE_ALL);

        $table = $this->getRequest()->getParam("table");

        $myTable = new App_Db_Table($table);
        $tableInfo = $myTable->info();

        $this->view->objet = $this->getRequest()->getParam("objet");
        $this->view->fieldPrefixe = $this->getRequest()->getParam("prefixe");
        $this->view->table = $table;
        $this->view->tableInfo = $tableInfo;
    }
}