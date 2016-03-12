<?php
/**
 * System de backup
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class BackupController extends App_Backoffice_Controller
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
     * Index des backups
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $backupModel = new Backup();
        $listeBackups = $backupModel->getListeBackup();

        $this->view->listeBackups = $listeBackups;
    }

    /**
     * Backup de la bdd
     *
     * @access public
     * @return void
     */
    public function bddAction(){
        $backup = new Backup();

        $backup->backupBdd();
        sleep(2);
        $backup->purgeBackup(Backup::BACKUP_TYPE_BDD);

    }

    /**
     * Backup des fichiers
     *
     * @access public
     * @return void
     */
    public function filesAction(){
        $backup = new Backup();

        $backup->backupFiles();
        sleep(2);
        $backup->purgeBackup(Backup::BACKUP_TYPE_FILES);
    }


}