<?php
/**
 * Gestion du paramétrage
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class ParamsController extends App_Backoffice_Controller
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
     * Index du paramétrage
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        // Test d'intégrité pour le paramétrage
        //ParamCustom::paramCheckIntegrite();
        //ParamCustom::save();

        $this->view->listeParametres = ParamDefault::tabParamDefault();
        $portailsModel = new Portail();
        $listePortails = $portailsModel->getListe();
        $this->view->listePortails = $listePortails;


    }

    /**
     * Synthese du paramétrage
     *
     * @access public
     * @return void
     */
    public function syntheseAction(){


    }

    /**
     * Check Integrite du paramétrage
     *
     * @access public
     * @return void
     */
    public function checkintegriteAction(){
        $cacheHandler = App_DI_Container::get('CacheManager')->getCache('default');
        // On vide totalement le cache
        $cacheHandler->clean(Zend_Cache::CLEANING_MODE_ALL);

        // Test d'intégrité pour le paramétrage
        ParamCustom::paramCheckIntegrite();
        ParamCustom::save();
    }

    /**
     * Export du paramétrage
     *
     * @access public
     * @return void
     */
    public function exportparamAction(){
        $tabParametres =
                array(	"system"=>		array("libelle"=>"Paramétrage des droits","commentaire"=>"","tables"=>array("zf_flags","zf_flippers","zf_groups","zf_privileges")),
                          "parametrage"=>	array("libelle"=>"Paramétrage de l'application","commentaire"=>"","tables"=>array("zf_paramcustom","zf_paramdefault")),
                        "emails"=>		array("libelle"=>"Paramétrage des emails","commentaire"=>"","tables"=>array("zf_emails")),
                        "portails"=>	array("libelle"=>"Paramétrage des portails","commentaire"=>"","tables"=>array("zf_portails","zf_portailurl")));

        $this->view->tabParametres = $tabParametres;

        $this->view->sql		=	"";

        if($this->_request->isPost()){

            $tabParametresExport = array();
            foreach($tabParametres as $key => $themeParametres){
                $paramExport = 	$this->_request->getParam($key,null);
                if($paramExport){
                    $tabParametresExport[$key] = $themeParametres;
                }
            }

            foreach($tabParametresExport as $parametreExport){
                foreach($parametreExport['tables'] as $tableName){
                    $dbAdapter = Zend_Registry::get('dbAdapter');
                    $listTableName = $dbAdapter->listTables();
                    $table = new App_Database($tableName);
                    $this->view->sql		.= "\n\nTRUNCATE TABLE ".$tableName.";\n";
                    $this->view->sql		.= $table->mysql_structure();
                }
            }
        }
    }
}