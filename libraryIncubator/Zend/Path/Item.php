<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Path
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/** 
 * Zend_Path 
 */
require_once 'Zend/Path.php';
/** 
 * Zend_Path_Exception 
 */
require_once 'Zend/Path/Exception.php';


/**
 * Zend_Path_Item provides an object oriented interface to path items.
 * 
 * @category   Zend
 * @package    Zend_Path
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Path_Item implements ArrayAccess 
{
    /**
     * The path.
     *
     * @var array
     */
    private $_path;
    
    /**
     * Creates a new Zend_Path_Item
     *
     * @param  string $path
     * @throws Zend_Path_Exception
     */
    public function __construct($path)
    {
        if (!is_string($path) || strlen($path)<1) throw new Zend_Path_Exception();
        $path=Zend_Path::normalizePath($path);
        $this->_path=explode(Zend_Path::getDirectorySeparator(), $path);
    }
    
    /**
     * Return the path.
     *
     * @return string
     */
    public function getPath()
    {
        if (count($this->_path)==1 && $this->_path[0]=="") return Zend_Path::getDirectorySeparator();
        return implode(Zend_Path::getDirectorySeparator(), $this->_path);
    }
    
    /**
     * Return a string representation of this path.
     *
     * @see    getPath()
     * @return string
     */
    public function __toString()
    {
        return $this->getPath();
    }
    
    /**
     * Change the extension of a file in a given path.
     *
     * @see    Zend_Path::changeExtension()
     * @param  string $newExtension
     * @return Zend_Path_Item
     */
    public function changeExtension($newExtension)
    {
        $new=Zend_Path::changeExtension($this->getPath(), $newExtension);
        return Zend_Path::factory($new);
    }

    /**
     * Combines two paths to a single path.
     *
     * @see    Zend_Path::combine()
     * @param  string|Zend_Path_Item $path2
     * @return Zend_Path_Item
     */
    public function combine($path2)
    {
        if ($path2 instanceof Zend_Path_Item) $path2=$path2->getPath();
        $new=Zend_Path::combine($this->getPath(), $path2);
        return Zend_Path::factory($new);
    }

    /**
     * Returns the directory name of a given path.
     * 
     * @see    Zend_Path::getDirectoryName()
     * @return string
     */
    public function getDirectoryName()
    {
        return Zend_Path::getDirectoryName($this->getPath());
    }

    /**
     * Returns the extension of a file in a given path.
     *
     * @see    Zend_Path::getExtension()
     * @return string
     */
    public function getExtension()
    {
        return Zend_Path::getExtension($this->getPath());
    }

    /**
     * Returns the filename of a given path.
     * 
     * @see    Zend_Path::getFilename()
     * @return string
     */
    public function getFilename()
    {
        return Zend_Path::getFilename($this->getPath());
    }

    /**
     * Returns the filename without its extension of a given path.
     *
     * @see    Zend_Path::getFilenameWithoutExtension()
     * @return string
     */
    public function getFilenameWithoutExtension()
    {
        return Zend_Path::getFilenameWithoutExtension($this->getPath());
    }

    /**
     * Returns the full path for a given relative path.
     *
     * @see    Zend_Path::getFullPath()
     * @return Zend_Path_Item
     */
    public function getFullPath()
    {
        $new=Zend_Path::getFullPath($this->getPath());
        return Zend_Path::factory($new);
    }

    /**
     * Returns the root path of a given path.
     * 
     * @see    Zend_Path::getPathRoot()
     * @return Zend_Path_Item
     */
    public function getPathRoot()
    {
        $new=Zend_Path::getPathRoot($this->getPath());
        return Zend_Path::factory($new);
    }

    /**
     * Returns true if the file in a given path has an extension. 
     *
     * @see    Zend_Path::hasExtension()
     * @return boolean
     */
    public function hasExtension()
    {
        return Zend_Path::hasExtension($this->getPath());
    }

    /**
     * Checks if the given path is rooted.
     *
     * @see    Zend_Path::isPathRooted()
     * @return boolean
     */
    public function isPathRooted()
    {
        return Zend_Path::isPathRooted($this->getPath());
    }
    
    /**
     * Resolves '..' and '.' in a given rooted path.
     *
     * @see    Zend_Path::normalizePath()
     * @return Zend_Path_Item
     */
    public function normalizePath()
    {
        $new=Zend_Path::normalizePath($this->getPath());
        return Zend_Path::factory($new);
    }
    
    /**
     * Checks if path is within the given root path.
     *
     * @see    Zend_Path::isWithinPath()
     * @param  string $rootPath
     * @return boolean
     */
    public function isWithinPath($rootPath)
    {
        return Zend_Path::isWithinPath($this->getPath(), $rootPath);
    }
    
    /**
     * Checks if the part of the path at $offest exists.
     * Implements ArrayAccess
     *
     * @param  integer $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
       return isset($this->_path[$offset]); 
    }
    
    /**
     * Returns the part of the path at $offest.
     * Implements ArrayAccess
     *
     * @param  integer $offset
     * @return string
     * @throws Zend_Path_Exception 
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) throw new Zend_Path_Exception();
        return $this->_path[$offset];
    }
    
    /**
     * Changes the part of the path at $offest.
     * Implements ArrayAccess
     *
     * @param  integer $offset
     * @param  string $value
     * @return null
     * @throws Zend_Path_Exception 
     */
    public function offsetSet($offset, $value)
    {
        if ($offset>count($this->_path)) throw new Zend_Path_Exception();
        $this->_path[$offset]=$value;
    }
    
    /**
     * Removes the part of the path at $offest.
     * Implements ArrayAccess
     *
     * @param  integer $offset
     * @return null
     * @throws Zend_Path_Exception 
     */
    public function offsetUnset($offset)
    {
        if (!$this->offsetExists($offset)) throw new Zend_Path_Exception();
        unset($this->_path[$offset]);
        $this->_path=array_values($this->_path);
    }
}