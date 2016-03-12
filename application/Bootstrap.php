<?php

/**
 * Generic bootstrap
 *
 * This class bootstraps the common issues in all modules
 * while each module's Bootstrap manages its own particular
 * configuration
 *
 * @package   application
 * @copyright RCWEB
 */
error_reporting(30719);
date_default_timezone_set("Europe/Paris"); // TDTODO : A mettre en paramètre
require_once "myUtils.php"; // TDTODO : A mettre au propre
require_once 'App/Bootstrap/Abstract.php';
class Bootstrap extends App_Bootstrap_Abstract
{

	protected function _initConf(){

		define("ESPACE_COLLABORATIF_PILOTE_ACTIVE",false);


		define("modulename_MODULE","/modulename");
		define("modulename_PATH",ROOT_PATH."/application/modules".modulename_MODULE);
		define("modulename_DATA_PATH",modulename_MODULE."/data");

		define("modulename_FOLDER_PATH",modulename_MODULE."/data/folder");
		define("modulename_FOLDER_PATH_ABS",modulename_PATH."/data/folder");





	}

    /**
     * Resources to be bootstrapped first
     *
     * @var    array
     * @access protected
     */
    protected $_first = array(
        'Autoloader',
        'Environment',
        'Paths',
        'OtherModules',
        'Db',
        'Portail',
        'WebUser',
        'Perf',
        'Params',
    );

    /**
     * Resources to be bootstrapped last
     *
     * @var    array
     * @access protected
     */
    protected $_last  = array(
        'Module',
        'ModulePaths',
        'Theme',
    );

    /**
     * Bootstraps the Autoloader
     *
     * @access protected
     * @return void
     */
    protected function _initAutoloader()
    {
        require_once 'Zend/Loader/Autoloader.php';

        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $loader->registerNamespace('Zend_');
        $loader->setFallbackAutoloader(TRUE);
    }

    /**
     * Includes the file with the environment constant - APPLICATION_ENV
     * If the file cannot be read or the constant isn't defined, an exception
     * will be throwed
     *
     * @access protected
     * @return void
     */
    protected function _initEnvironment()
    {
        $file = APPLICATION_PATH . '/configs/environment.php';
        if (!is_readable($file)) {
            throw new Zend_Exception('Cannot find the environment.php file!');
        }

        require_once ($file);
        if (!defined('APPLICATION_ENV')) {
            throw new Zend_Exception('The APPLICATION_ENV constant is not defined in ' . $file);
        }

        Zend_Registry::set('IS_PRODUCTION', APPLICATION_ENV == APP_STATE_PRODUCTION);
        Zend_Registry::set('IS_DEVELOPMENT', APPLICATION_ENV == APP_STATE_DEVELOPMENT);
        Zend_Registry::set('IS_STAGING', APPLICATION_ENV == APP_STATE_STAGING);
    }

    /**
     * Initialize App paths and App/Models paths
     *
     * @access protected
     * @return void
     */
    protected function _initPaths(){
        $paths = array(
                ROOT_PATH . '/library/App/Models',
                get_include_path() ,
        );

        set_include_path(implode(PATH_SEPARATOR, $paths));
    }

    /**
     * Store the app version in the registry
     *
     * @access protected
     * @return void
     */
    protected function _initAppVersion()
    {
        $configuration = App_DI_Container::get('ConfigObject');

        // Register the version of the app
        if (isset($configuration->release->version)) {
            define('APP_VERSION', $configuration->release->version);
        } else {
            define('APP_VERSION', 'unknown');
        }

        Zend_Registry::set('APP_VERSION', APP_VERSION);
    }

    /**
     * Bootstraps the current module
     * This relies on the CURRENT_MODULE constant, if it's not defined
     * an exception will the throwed
     *
     * @access protected
     * @return void
     */
    protected function _initModule()
    {
        if (!defined('CURRENT_MODULE')) {
            throw new Zend_Exception('The CURRENT_MODULE module constant is' .
                ' not defined! Please check the index.php file for this module.');
        }

        $filename = APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/Bootstrap.php';
        if (is_readable($filename)) {
            require_once $filename;
            $class = ucfirst(CURRENT_MODULE . '_Bootstrap');
            if (!class_exists($class)) {
                throw new Zend_Exception('Class ' . $class . ' could not be found in file ' . $filename);
            }

            $module = new $class();
        }
    }

    /**
     * Inits the current module's paths
     * This relies on the CURRENT_MODULE constant, if it's not defined
     * an exception will be throwed
     *
     * @access protected
     * @return void
     */
    protected function _initModulePaths()
    {
        if (!defined('CURRENT_MODULE')) {
            throw new Zend_Exception('The CURRENT_MODULE module constant is' .
                ' not defined! Please check the index.php file for this module.');
        }

        $paths = array(
            APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/controllers',
            APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/library',
            APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/models',
            APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/library/App/Models',
            APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/forms',
            get_include_path() ,
        );

        set_include_path(implode(PATH_SEPARATOR, $paths));

    }


    protected function _initOtherModules(){
        $listeModules 	= array();
        $dirModules		= APPLICATION_PATH."/modules";
        $listNoModule	= array(".","..",".svn",".git");

        // Listing des modules
        if (is_dir($dirModules)) {
            if ($dh = opendir($dirModules)) {
                while (($moduleName = readdir($dh)) !== false) {
                    if (!in_array($moduleName,$listNoModule)) {
                        $dirModule        =    Zend_Path::combine($dirModules,$moduleName);
                        if (is_dir($dirModule)) {
                            // Liste de tous les modules
                            $listeModules[] = $moduleName;
                        }
                    }
                }
            }
            closedir($dh);
        }
        Zend_Registry::set('listeModules', $listeModules);
    }

    /**
     * Bootstraps the front controller
     *
     * @access protected
     * @return void
     */
    protected function _initFrontController()
    {
        $front = Zend_Controller_Front::getInstance();

        $front->addModuleDirectory(APPLICATION_PATH . '/modules');
        $front->setDefaultModule(CURRENT_MODULE);
    }

    /**
     * Initializes the database connection
     *
     * @access protected
     * @return void
     */
    protected function _initDb()
    {
        $config = App_DI_Container::get('ConfigObject');

        $dbAdapter = Zend_Db::factory($config->resources->db);
        Zend_Db_Table_Abstract::setDefaultAdapter($dbAdapter);

        Zend_Registry::set('dbAdapter', $dbAdapter);

        Zend_Db_Table_Abstract::setDefaultMetadataCache(App_DI_Container::get('CacheManager')->getCache('default'));
    }

    /**
     * Initializes the view helpers for the application
     *
     * @access protected
     * @return void
     */
    protected function _initViewHelpers()
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        if (NULL === $viewRenderer->view) {
            $viewRenderer->initView();
        }

        $viewRenderer->view->addHelperPath('App/View/Helper', 'App_View_Helper');
        //$viewRenderer->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');
    }

    /**
     * Initializes the action helpers for the application
     *
     * @return void
     */
    protected function _initActionHelpers()
    {
        // Add the possibility to log to Firebug. Example: $this->_helper->log('Message');
        Zend_Controller_Action_HelperBroker::addHelper(new App_Controller_Action_Helper_Logger());

        // Add the Flag and Flippers helper for the controllers. Example: $this->_helper->flagFlippers()
        Zend_Controller_Action_HelperBroker::addHelper(new App_Controller_Action_Helper_FlagFlippers());

        // Add the translator helper to all the modules
        Zend_Controller_Action_HelperBroker::addHelper(new App_Controller_Action_Helper_T());
    }

    /**
     * Setup the locale based on the browser
     *
     * @return void
     */
    protected function _initLocale()
    {
        $locale = new Zend_Locale();

        if (!Zend_Locale::isLocale($locale, TRUE, FALSE)) {
            if (!Zend_Locale::isLocale($locale, FALSE, FALSE)) {
                throw new Zend_Locale_Exception("The locale '$locale' is no known locale");
            }

            $locale = new Zend_Locale($locale);
        }

        //Remove this!
        $locale = new Zend_Locale('en_EN');

        if ($locale instanceof Zend_Locale) {
            Zend_Registry::set('Zend_Locale', $locale);
        }

        Zend_Registry::set('Lang', "fr");
    }

    /**
     * Inits the layouts (full configuration)
     *
     * @access protected
     * @return void
     */
    protected function _initLayout()
    {
        Zend_Layout::startMvc(APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/views/layouts/');
    }

    /**
     * Inits the view paths
     *
     * Additional paths are used in order to provide a better separation
     *
     * @access protected
     * @return void
     */
    protected function _initViewPaths()
    {
        $this->bootstrap('Layout');

        $view = Zend_Layout::getMvcInstance()->getView();

        $view->addScriptPath(APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/views/');
        $view->addScriptPath(APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/views/forms/');
        $view->addScriptPath(APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/views/paginators/');
        $view->addScriptPath(APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/views/scripts/');
        $view->addScriptPath(ROOT_PATH . '/library/App/Mail/Templates/');

        Zend_Registry::set("baseUrl", $view->baseUrl());
    }

    /**
     * Initialize the ZFDebug Widget
     *
     * @return void
     */
    protected function _initZFDebug()
    {
        $config = App_DI_Container::get('ConfigObject');

        $dbAdapter = Zend_Registry::get('dbAdapter');

        /**/
        $forceDebug = false;
        $webUser = Zend_Registry::get("WebUser"); /* @var $webUser App_WebUser */
        if(ParamCustom::param("FRAMEWORK.FORCE_IP_DEBUG","FRAMEWORK")){
            $ips = explode(";",ParamCustom::param("FRAMEWORK.FORCE_IP_DEBUG","FRAMEWORK"));
            if(in_array($webUser->get_ip(), $ips)){
                $forceDebug = true;
            }
        }
        if(ParamCustom::param("FRAMEWORK.DEBUG","FRAMEWORK") || $forceDebug ){
            define("DEBUG",true);
        }else{
            define("DEBUG",false);
        }
        if (!DEBUG)
        {
            set_error_handler('errorToExceptionHandler');
            return FALSE;
        }

        $options = array(
            'plugins' => array(
                'Variables',
                'Html',
                'ZFDebug_Controller_Plugin_Debug_Plugin_Debug' => array('tab'   => 'Debug',
                            'panel' => ''),
                'ZFDebug_Controller_Plugin_Debug_Plugin_Auth' => array("user"=>"username","role"=>"group"),
                'Database' => array('adapter' => array('default' => $dbAdapter)),
                'File' => array('basePath' => ROOT_PATH),
                'Memory',
                'Time',
                'Registry',
                'Exception'
            )
        );

        if ($config->zfdebug->show_cache_panel) {
            $defaultCache = App_DI_Container::get('CacheManager')->getCache('default');

            $options['plugins']['Cache'] = array(
                'backend' => array(
                    $defaultCache->getBackend(),
                )
            );
        }

        $debug = new ZFDebug_Controller_Plugin_Debug($options);

        $frontController = Zend_Controller_Front::getInstance()->registerPlugin($debug);
    }

    /**
     * Initialize and register the plugins
     *
     * @access protected
     * @return void
     */
    protected function _initPlugins()
    {
        $frontController = Zend_Controller_Front::getInstance();
        // Application_Plugin_VersionHeader sends a X-SF header with the system version for debugging
        $frontController->registerPlugin(new App_Plugin_VersionHeader());
        // Plugin de sauvegarde des informations de routage appliquée à la requête en cours
        $frontController->registerPlugin(new App_Plugin_SaveOrigin());
        // Application_Plugin_Perfs calculate the generation time
        $frontController->registerPlugin(new App_Plugin_Perfs());
        // Application_Plugin_Perfs calculate the generation time
        $frontController->registerPlugin(new App_Plugin_Online());
    }

    /**
     * Initialize the routes
     *
     * @return void
     */
    protected function _initRouter(){
        $router = new Zend_Controller_Router_Rewrite();

        $routes = new Zend_Config_Xml(APPLICATION_PATH . '/configs/' . CURRENT_MODULE . '_routes.xml');
        $router->addConfig($routes,'routes');

        /*$route = new Zend_Controller_Router_Route(
                '/generateModel/model/:table',
                array(
                        'controller' => 'generate',
                        'action'     => 'generate'
                )
        );
        $router->addRoute('generate', $route);*/

        $front = Zend_Controller_Front::getInstance();
        $front->setRouter($router);

        Zend_Registry::set('Router', $router);
    }

    /**
     * Initialize the translation system
     *
     * @return void
     */
    protected function _initTranslator(){
        $this->bootstrap('Locale');

        //Extract some info from the request
        $lang = Zend_Registry::get('Zend_Locale')->getLanguage();
        $translationFile = ROOT_PATH . '/library/App/Translations/' . $lang . '.mo';

        //Check if the translations file is available, if not fallback default to english
        if(!file_exists($translationFile)){
            $translationFile = APPLICATION_PATH . '/modules/' . CURRENT_MODULE . '/translations/en.mo';
        }

        $options = array(
                'adapter' => 'gettext',
                'content' => $translationFile,
                'locale'  => $lang,
                'disableNotices' => App_DI_Container::get('ConfigObject')->translations->disable_notices,
                'logMessage' => "Missing translation: %message%",
                'logUntranslated' => App_DI_Container::get('ConfigObject')->translations->log_missing_translations
        );

        //Create a zend_log for missing translations
        if(App_DI_Container::get('ConfigObject')->translations->log_missing_translations){
            $pathLog = ROOT_PATH . '/logs/' . CURRENT_MODULE . '/missing_translations/' . date('Ymd') . '_' . $lang . '.log';
            $writer = new Zend_Log_Writer_Stream($pathLog);
            $logger = new Zend_Log($writer);

            $options['log'] = $logger;
        }

        $translate = new Zend_Translate($options);

        Zend_Registry::set('Zend_Translate', $translate);

        Zend_Validate_Abstract::setDefaultTranslator($translate);
        Zend_Form::setDefaultTranslator($translate);
    }

    /**
     * Initialize the Flag and Flipper System
     *
     * @return void
     */
    protected function _initFlagFlippers()
    {
        $this->bootstrap('ModulePaths');

        $path = realpath(APPLICATION_PATH . '/../logs/' . CURRENT_MODULE . '/flagflippers.log');
        $logger = new Zend_Log(new Zend_Log_Writer_Stream($path));

        if (!Zend_Registry::get('IS_PRODUCTION')) {
            $logger->addWriter(new Zend_Log_Writer_Firebug());
        }

        Zend_Registry::set('Zend_Log_FlagFlippers', $logger);

        //App_FlagFlippers_Manager::$indexKey = CURRENT_MODULE.'FlagFlippers';
        App_FlagFlippers_Manager::load();
    }

    /**
     * Initialize and configure the jQuery options
     *
     * @return void
     */
    protected function _initJQuery()
    {
        /*$view = Zend_Layout::getMvcInstance()->getView();
        $view->jQuery()->addStylesheet('/css/jquery-ui.css');
        $view->jQuery()->setLocalPath('/js/jquery.min.js');
        $view->jQuery()->setUiLocalPath('/js/jquery-ui.min.js');*/
    }

    /**
     * Runs the application
     *
     * @access public
     * @return void
     */
    public function runApp()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->dispatch();
    }

    protected function _initCheckDbSchema(){
        $config = App_DI_Container::get('ConfigObject');
        // Initialisation du registre
            $registry = Zend_Registry::getInstance();
            $db = $registry->get('dbAdapter');
            $schemaPath = APPLICATION_PATH.'/configs/schema';
            if(file_exists($schemaPath.'/schema.php')){
                include_once $schemaPath.'/schema.php';
                $select = $db->select()
                ->from( 'zf_db_schema' );
                $stmt = $select->query();
                $result = $stmt->fetch();
                $current_rev = $result["rev_schema"];

                if($current_rev != REV_SCHEMA){
                    // some flags to filter . and .. and follow symlinks
                    $flags = \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::FOLLOW_SYMLINKS;
                    // create a simple recursive directory iterator
                    $iterator = new \RecursiveDirectoryIterator($schemaPath, $flags);
                    // make it a truly recursive iterator
                    $iterator = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);

                    if(defined("DEBUG") && DEBUG){
                        trigger_error('Attention, votre schéma de base de données n\'est pas à jour.',E_USER_WARNING);
                    }

                    foreach ($iterator as $file)
                    {
                        if (preg_match('/(^\d+).*\.sql$/', $file->getFilename(),$matches))
                        {
                            //debug($file->getFilename());
                            //debug($matches);
                            $majScript = $matches[1];
                            if($majScript > $current_rev){
                                if(DEBUG){
                                    trigger_error('Vous devez mettre à jour votre base avec le fichier "'.$file->getFilename().'"',E_USER_WARNING);
                                }
                            }
                        }
                    }
                }

            }else{
                define('REV_SCHEMA',false);
            }
            $registry->set("REV_SCHEMA",REV_SCHEMA);
    }

    /**
     * Initialize the Portail
     *
     * @return void
     */
    protected function _initPortail()
    {
        $this->bootstrap('Db');
        // Récupération du server name (ie domaine)
        $serverName = @$_SERVER['SERVER_NAME'];
        $httpHost = @$_SERVER['HTTP_HOST'];
        Zend_Registry::set('SERVER_NAME', $serverName);
        Zend_Registry::set('HTTP_HOST', $httpHost);

        $absolute_url = full_url($_SERVER);

        // SECURITY : On vérifie que l'url utilisée correspond bien à une url paramétrée
        $portailUrlModel = new PortailUrl($serverName,null,"portailurl_url");
        Zend_Registry::set('PortailId', $portailUrlModel->getPortailurl_portail_id());
        Zend_Registry::set('PortailUrl',$portailUrlModel);
        Zend_Registry::set('Portail',$portailUrlModel->getPortail());
        Zend_Registry::set('Environment', $portailUrlModel->getPortail()->getPortail_environnement());
        Zend_Registry::set('FullUrl', $absolute_url);

        $listePortailUrl = $portailUrlModel->getListe();
        foreach($listePortailUrl as $portailUrl){ /* @var $portailUrl PortailUrl */
            $allowed_hosts[] = $portailUrl->getPortailurl_url();
        }
        if (	//!isset($_SERVER['HTTP_HOST']) ||
                //!in_array($_SERVER['HTTP_HOST'], $allowed_hosts) ||
                !isset($_SERVER['SERVER_NAME']) ||
                !in_array($_SERVER['SERVER_NAME'], $allowed_hosts) ||
                !(strpos($_SERVER["HTTP_HOST"],$_SERVER["SERVER_NAME"])!==false) // http://shiflett.org/blog/2006/mar/server-name-versus-http-host
                                                                                 // Check whether the value of $_SERVER["HTTP_HOST"] is contained in $_SERVER["SERVER_NAME"],
                                                                                 // for example: subdomain.example.com in example.com
        ) {
            // Robots meta tag and X-Robots-Tag HTTP header specifications https://developers.google.com/webmasters/control-crawl-index/docs/robots_meta_tag
            header('X-Robots-Tag: none');
            header('Content-Type: text/plain');
            header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
            exit;
        }

    }

    /**
     * Initialize les perfs
     *
     * @return void
     */
    protected function _initPerf()
    {
        $benchmark = new App_Perfs_Benchmark();
        $benchmark->mark('total_execution_time_start');
        Zend_Registry::set("benchmark",$benchmark);
    }

    /**
     * Initialize the Params System
     *
     * @return void
     */
    protected function _initParams()
    {
        $this->bootstrap('Portail');
        ParamCustom::load();

        // On applique alors le paramétrage
        if(ParamCustom::param("DB.PROFILER","FRAMEWORK")){
            // active le profileur :
            $dbAdapter = Zend_Registry::get('dbAdapter');
            $dbAdapter->getProfiler()->setEnabled(true);
        }
    }

    /**
     * Initialize the Online System
     *
     * @return void
     */
    protected function _initWebUser()
    {
        $webUser = new App_WebUser();
        Zend_Registry::set('WebUser',$webUser);
    }

    /**
     * Initialize the Theme System
     *
     * @return void
     */
    protected function _initTheme()
    {
        $portail = Zend_Registry::get('Portail');
        $front = Zend_Controller_Front::getInstance();
        $front->setPortail = $portail->getPortail_Theme();
    }

}
