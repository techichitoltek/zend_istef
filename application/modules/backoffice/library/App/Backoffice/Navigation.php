<?php
/**
 * Holds the backoffice's navigation system
 *
 *
 * @category App
 * @package App_Backoffice
 * @subpackage Navigation
 * @copyright RCWEB
 */

class App_Backoffice_Navigation
{
    /**
     * Singleton object for this class
     *
     * @var App_Backoffice_Navigation
     * @access protected
     */
    protected static $_instance;

    /**
     * Holds the navigation array
     *
     * @var array
     * @access protected
     */
    protected $_navigation;

    /**
     * Constructs the Navigation object. Must not be called directly
     *
     * @access public
     * @return void
     */
    protected function __construct(){
        $this->_navigation = $this->_markActive($this->_filter($this->_getPages()));
    }

    /**
     * Returns a singleton instance of the class
     *
     * @access public
     * @return void
     */
    public static function getInstance(){
        if (NULL === self::$_instance) {
            self::$_instance = new App_Backoffice_Navigation();
        }

        return self::$_instance;
    }

    /**
     * Implements the __clone() magic method, forbidding the cloning
     * of this object
     *
     * @access public
     * @return void
     */
    public function __clone(){
        throw new Zend_Exception('Cloning singleton objects is forbidden');
    }

    /**
     * Returns an array of pages
     *
     * @access protected
     * @return void
     */
    protected function _getPages(){
        $pages = array(
            array(
                'main' => array(
                    'label' => 'Dashboard',
                    'controller' => 'dashboard',
                    'action' => 'index'
                ),
                'pages' => array(
                    array(
                            'label' => 'Summary',
                            'controller' => 'dashboard',
                            'action' => 'index',
                    ),
                    array(
                        'label' => 'Profile',
                        'controller' => 'profile',
                        'action' => 'index',
                    ),
                	array(
                		'label' => 'Phpinfo',
                		'controller' => 'system',
                		'action' => 'phpinfo',
                	),
                ),
            ),
            array(
                'main' => array(
                    'label' => 'System',
                    'controller' => 'system',
                    'action' => 'index'
                ),
                'pages' => array(
                    array(
                        'label' => 'Groups',
                        'controller' => 'groups',
                        'action' => 'index',
                        'scope' => '*'
                    ),
                    array(
                        'label' => 'Users',
                        'controller' => 'users',
                        'action' => 'index',
                        'scope' => '*'
                    ),
                    array(
                        'label' => 'Privileges',
                        'controller' => 'privileges',
                        'action' => 'index',
                        'scope' => '*'
                    ),
                    array(
                        'label' => 'Flags',
                        'controller' => 'flags',
                        'action' => 'index',
                        'scope' => '*'
                    ),
                ),

            ),
                array(
                        'main' => array(
                                'label' => 'Parameters',
                                'controller' => 'portails',
                                'action' => 'index'
                        ),
                        'pages' => array(
                                array(
                                        'label' => 'Portails',
                                        'controller' => 'portails',
                                        'action' => 'index',
                                        'scope' => '*'
                                ),
                                array(
                                        'label' => 'PortailUrl',
                                        'controller' => 'portailurl',
                                        'action' => 'index',
                                        'scope' => '*'
                                ),
                                array(
                                        'label' => 'Paramètres',
                                        'controller' => 'params',
                                        'action' => 'index',
                                        //'scope' => '*'
                                ),
                                array(
                                        'label' => 'Mails',
                                        'controller' => 'mails',
                                        'action' => 'index',
                                        'scope' => '*'
                                ),
                                array(
                                        'label' => 'Exporter',
                                        'controller' => 'params',
                                        'action' => 'exportparam',
                                        //'scope' => 'export'
                                ),
                        ),
                ),
                array(
                        'main' => array(
                                'label' => 'Tools',
                                'controller' => 'tools',
                                'action' => 'index'
                        ),
                        'pages' => array(
                                array(
                                        'label' => 'Generate Models',
                                        'controller' => 'generate',
                                        'action' => 'index',
                                        'scope' => '*'
                                ),
                                array(
                                        'label' => 'Clear Cache',
                                        'controller' => 'tools',
                                        'action' => 'cleancache',
                                        //'scope' => '*'
                                ),
                                array(
                                        'label' => 'Bdd',
                                        'controller' => 'tools',
                                        'action' => 'adminer',
                                        //'scope' => '*'
                                ),

                        ),
                ),
                array(
                        'main' => array(
                                'label' => 'Backups',
                                'controller' => 'backup',
                                'action' => 'index'
                        ),
                        'pages' => array(
                                array(
                                        'label' => 'Backup Bdd',
                                        'controller' => 'backup',
                                        'action' => 'bdd',
                                        //'scope' => '*'
                                ),
                                array(
                                        'label' => 'Backup Files',
                                        'controller' => 'backup',
                                        'action' => 'files',
                                        //'scope' => '*'
                                ),

                        ),
                ),
                array(
                        'main' => array(
                                'label' => 'Benchmark',
                                'controller' => 'benchmark',
                                'action' => 'index'
                        ),
                        'pages' => array(
                                array(
                                        'label' => 'Benchmark 1',
                                        'controller' => 'benchmark',
                                        'action' => 'benchmark1',
                                        //'scope' => '*'
                                ),
                                array(
                                        'label' => 'Benchmark 2',
                                        'controller' => 'benchmark',
                                        'action' => 'benchmark2',
                                        //'scope' => '*'
                                ),

                        ),
                ),
                array(
                        'main' => array(
                                'label' => 'Examples',
                                'controller' => 'system',
                                'action' => 'example'
                        ),
                        'pages' => array(
                                array(
                                        'label' => 'Theme',
                                        'controller' => 'system',
                                        'action' => 'example',
                                        //'scope' => '*'
                                ),
                                array(
                                        'label' => 'Errors',
                                        'controller' => 'system',
                                        'action' => 'example-errors',
                                        //'scope' => '*'
                                ),

                        ),

                ),
        );

        return $pages;
    }

    /**
     * Returns an array with all the pages that will be available for
     * the current user
     *
     * @param array $data
     * @access protected
     * @return array
     */
    protected function _filter($data){
        $filtered = array();

        foreach($data as $tab){
            $filteredPages = array();
            if(isset($tab['pages'])){
                foreach($tab['pages'] as $page){
                    if(App_FlagFlippers_Manager::isAllowed(NULL, $page['controller'], $page['action'])){
                        $filteredPages[] = $page;
                    }
                }
            }

            if(!empty($filteredPages)){
                $filteredTab = array(
                    'main' => $tab['main'],
                    'pages' => $filteredPages,
                );

                $filtered[] = $filteredTab;
            }
        }

        return $filtered;
    }

    /**
     * Marks the current tab as active
     *
     * @param arrat $pages
     * @access protected
     * @return array
     */
    protected function _markActive($menu){
        $controllerName = Zend_Registry::get('controllerName');
        $actionName = Zend_Registry::get('actionName');

        foreach($menu as $tabKey => $tab){
            if ($controllerName === $tab['main']['controller'] && $actionName === $tab['main']['action']){
                $menu[$tabKey]['main']['active'] = TRUE;
            }

            if(isset($tab['pages'])){
                foreach($tab['pages'] as $pagekey => $page) {
                    if($controllerName === $page['controller'] && ($actionName === $page['action'] || (array_key_exists('scope', $page) && $page['scope'] == '*'))){
                        $menu[$tabKey]['pages'][$pagekey]['active'] = TRUE;
                        $menu[$tabKey]['main']['active'] = TRUE;
                        break;
                    }
                }
            }
        }

        return $menu;
    }

    /**
     * Returns the navigation array
     *
     * @access public
     * @return array
     */
    public function getNavigation(){
        return $this->_navigation;
    }

    /**
     * Update the navigation array
     *
     * @access public
     * @param array $menu
     * @return array
     */
    public function setNavigation(array $menu){
        $this->_navigation = $menu;
    }
}