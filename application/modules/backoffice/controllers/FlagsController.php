<?php
/**
 * Allows user to manage the flags
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class FlagsController extends App_Backoffice_Controller
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
     * Allows the user to view all the flags registered in the application
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $this->title = '';

        $flagModel = new Flag();
        $this->view->paginator = $flagModel->findAll($this->_getPage());
    }

    /**
     * Change the active status of a flag on production
     *
     * @access public
     * @return void
     */
    public function toggleprodAction(){
        $id = $this->getRequest()->getParam('id');

        $flagModel = new Flag();
        $flagModel->toggleFlag($id, APP_STATE_PRODUCTION);

        App_FlagFlippers_Manager::save();

        $this->_redirect('/flags/');
    }

    /**
     * Change the active status of a flag on development
     *
     * @access public
     * @return void
     */
    public function toggledevAction(){
        $id = $this->getRequest()->getParam('id');

        $flagModel = new Flag();
        $flagModel->toggleFlag($id, APP_STATE_DEVELOPMENT);

        App_FlagFlippers_Manager::save();

        $this->_redirect('/flags/');
    }

    /**
     * Generate SQL flags and privileges
     *
     * @access public
     * @return void
     */
    public function generatesqlAction(){
        $module = $this->getRequest()->getParam('mod','');

        if(!empty($module)){
            $paths = array(
                    APPLICATION_PATH . '/modules/' . $module . '/library',
                    get_include_path() ,
            );

            set_include_path(implode(PATH_SEPARATOR, $paths));
            $path = APPLICATION_PATH . '/modules/' . $module . '/controllers';

            if (!is_readable($path)) {
                echo 'Error! Path ' . $path . ' is not readable.';
                exit();
            }

            /**
            $files = array();
            if (is_file($path)) {
                $files  []= basename($path);
                $path = dirname($path);
            } else {
                if (($dir = opendir($path)) !== false) {
                    while (($file = readdir($dir)) !== false) {
                        if (fnmatch('*.php', $file) && $file !== 'ErrorController.php') {
                            $files[]= $file;
                        }
                    }
                    closedir($dir);
                }
            }
            /**/

            $files = listControllers($path);
            $resources = array();

            foreach ($files as $file) {
                $filepath = $path . DIRECTORY_SEPARATOR . $file;
                require_once $filepath;

                $reflectionFile = new Zend_Reflection_File($filepath);
                foreach($reflectionFile->getClasses() as $class) {
                    $classInfo = array(
                            'description' => $class->getDocblock()->getShortDescription(),
                            'name' => strtolower($module) . '-' . App_Inflector::convertControllerName($class->getName()),
                            'methods' => array(),
                    );

                    foreach ($class->getMethods() as $method) {
                        if (substr($method->getName(), -6) == 'Action') {
                            $classInfo['methods'][] = array(
                                    'description' => $method->getDocblock()->getShortDescription(),
                                    'name' => App_Inflector::convertActionName($method->getName()),
                            );
                        }
                    }

                    $resources[] = $classInfo;
                }
            }

            $flagFlippers = App_Cli_FlagFlippers::getInstance();
            $inserts = $flagFlippers->generateInserts($resources);

            $this->view->inserts = $inserts;
        }

        $this->view->mod = $module;
    }
}