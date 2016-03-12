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
 * Zend_Path_Exception
 */
require_once 'Zend/Path/Exception.php';

/**
 * Zend_Path provides methods to work with filesystem paths.
 *
 * @category   Zend
 * @package    Zend_Path
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
final class Zend_Path
{
	/**
     * Singleton pattern implementation makes "new" unavailable.
     *
     */
    private function __construct()
    {}

    /**
     * Singleton pattern implementation makes "clone" unavailable.
     *
     */
    private function __clone()
    {}

    /**
     * Creates a Zend_Path_Item for the given path to provide an
     * object oriented interface to Zend_Path-methods.
     *
     * @param  string $path
     * @return Zend_Path_Item
     * @throws InvalidArgumentException
     */
    public static function factory($path)
    {
        /**
         * Zend_Path_Item
         */
        require_once 'Zend/Path/Item.php';
        return new Zend_Path_Item($path);
    }

	/**
	 * Return the directory separator for the current system.
	 *
	 * Returns '/' on Unix-based machines and '\' on Windows-based machines.
	 *
	 * @return string
	 */
	public static function getDirectorySeparator() { return DIRECTORY_SEPARATOR; }

	/**
	 * Return the alternative directory separator for the current system.
	 *
	 * Returns '/' for every system as Windows can work with '/'-paths.
	 *
	 * @return string
	 */
	public static function getAltDirectorySeparator()
	{
		return "/";
	}

	/**
	 * Return the path separator for the current system.
	 *
	 * Returns ':' on Unix-based machines and ';' on Windows-based machines.
	 *
	 * @return string
	 */
	public static function getPathSeparator() { return PATH_SEPARATOR; }

	/**
	 * Return the volume separator for the current system.
	 *
	 * As volume separators are a Windows-specific issue, this method
	 * returns '/' on all Unix-based machines and ':' on Windows.
	 *
	 * @return string
	 */
	public static function getVolumeSeparator()
	{
		if (self::_isWindows()) return ":";
		else return "/";
	}

	/**
	 * Change the extension of a file in a given path.
	 *
	 * If the given path does not haven an extension, the extension
	 * provided gets appended to the path.
	 *
	 * @param  string $path
	 * @param  string $newExtension
	 * @return string
	 */
	public static function changeExtension($path, $newExtension)
	{
		if (!is_null($newExtension) && substr($newExtension, 0, 1)!=".") $newExtension="." . $newExtension;

		$return="";
		if (!self::hasExtension($path))
		{
			if (!is_null($newExtension)) $return=self::combine(null, $path . $newExtension);
			else $return=self::combine(null, $path);
		}

		$dir=self::getDirectoryName($path);
		$fileNoExt=self::getFileNameWithoutExtension($path);
		if (is_null($newExtension)) $return=self::combine($dir, $fileNoExt);
		else $return=self::combine($dir, $fileNoExt . $newExtension);
		return $return;
	}

	/**
	 * Combines two paths to a single path.
	 *
	 * If $path2 is rooted, $path2 is returned.
	 * If either $path1 or $path2 is null or empty, the other path is returned
	 * respectively.
	 *
	 * @param  string $path1
	 * @param  string $path2
	 * @return string
	 */
	public static function combine($path1, $path2)
	{
		$retPath="";
		if (self::isPathRooted($path2)) $retPath=$path2;
		else if (is_null($path1) || strlen($path1)==0) $retPath=$path2;
		else if (is_null($path2) || strlen($path2)==0) $retPath=$path1;
		else
		{
			$p1Last=substr($path1, -1);
			if ($p1Last==self::getDirectorySeparator() ||
				$p1Last==self::getAltDirectorySeparator())
				$retPath=$path1 . $path2;
			else $retPath=$path1 . self::getDirectorySeparator() . $path2;
		}

		$rpLast=substr($retPath, -1);
		if ($rpLast==self::getDirectorySeparator() ||
			$rpLast==self::getAltDirectorySeparator())
			$retPath=substr($retPath, 0, -1);

		if (substr($retPath, -1)==self::getVolumeSeparator())
		{
			$retPath.=self::getDirectorySeparator();
		}
		$retPath=self::_normalizeDirectorySeparators($retPath);
		return $retPath;
	}

	/**
	 * Returns the directory name of a given path.
	 *
	 * The directory name in this context is everything until the
	 * last '/' or '\' in the given path string.
	 *
	 * @param  string $path
	 * @return string
	 */
	public static function getDirectoryName($path)
	{
		$dir=dirname($path);
		if ($dir==='.') return '';
		else if ($dir==='..') return '..' . self::getDirectorySeparator();
		else
		{
			if (substr($dir, -1)==self::getVolumeSeparator())
			{
				$dir.=self::getDirectorySeparator();
			}
			return self::_normalizeDirectorySeparators($dir);
		}
	}

	/**
	 * Returns the extension of a file in a given path.
	 *
	 * The extension in this context is defined as the part of the string
	 * after the *last* period. The extension is returned without the '.'.
	 *
	 * @param  string $path
	 * @return string
	 */
	public static function getExtension($path)
	{
		$filename=self::getFilename($path);
		$posDot=strrpos($filename, ".");
		if ($posDot===false) return "";
		else return substr($filename, $posDot+1);
	}

	/**
	 * Returns the filename of a given path.
	 *
	 * The returned string is not necessarily a real file. It
	 * can also be a directory. This method just returns the part
	 * of the string after the last  '/' or '\' in the given path string.
	 * The returned filename includes the file extension if one is present.
	 *
	 * @param  string $path
	 * @return string
	 */
	public static function getFilename($path)
	{
		return basename($path);
	}

	/**
	 * Returns the filename without its extension of a given path.
	 *
	 * The returned string is not necessarily a real file. It
     * can also be a directory. This method just returns the part
     * of the string after the last  '/' or '\' and before the last '.'
     * in the given path string.
     *
	 * @param  string $path
	 * @return string
	 */
	public static function getFilenameWithoutExtension($path)
	{
		$file=self::getFilename($path);
		$posDot=strrpos($file, ".");
		if ($posDot===false) return $file;
		else return substr($file, 0, $posDot);
	}

	/**
	 * Returns the full path for a given relative path.
	 *
	 * If $path is already rooted $path1 will be returned unchanged.
	 *
	 * @param  string $path
	 * @return string
	 */
	public static function getFullPath($path)
	{
		if (self::isPathRooted($path)) return self::_normalizeDirectorySeparators($path);
		else
		{
			$currentDir=getcwd();
			return self::combine($currentDir, $path);
		}
	}

	/**
	 * Returns the root path of a given path.
	 *
	 * If the given path is not rooted, an empty string will be returned.
	 * On Unix-based machines this will always be '/'. On Windows machines
	 * a 'full' root ('C:\' e.g.) will be returned if the given path includes
	 * a drive letter, otherwise '\' will be returned
	 *
	 * @param  string $path
	 * @return string
	 */
	public static function getPathRoot($path)
	{
		if (!self::isPathRooted($path)) return "";
		if (self::_isWindows())
		{
			$pos2=substr($path, 1, 1);
			if ($pos2==self::getVolumeSeparator())
				return substr($path, 0, 2) . self::getDirectorySeparator();
			else return self::getDirectorySeparator();
		}
		else return self::getVolumeSeparator();

	}

	/**
	 * Returns a random filename.
	 *
	 * This method is a mere wrapper around uniqid(rand(), true).
	 *
	 * @return string
	 */
	public static function getRandomFileName()
	{
		return uniqid(rand(), true);
	}

	/**
	 * Returns the path to a random temporary file in the current
	 * system's temp-path.
	 *
	 * @return string
	 */
	public static function getTempFileName()
	{
		return self::_normalizeDirectorySeparators(tempnam(self::getTempDirectory(), self::getRandomFileName()));
	}

	/**
	 * Returns the current system's temp-path.
	 *
	 * This method tries to determine the temp-path using several
	 * attemps according to a snippet by minghong at gmail dot com
	 * @link http://de3.php.net/manual/en/function.sys-get-temp-dir.php#71332
	 *
	 * @return string
	 */
	public static function getTempDirectory()
	{
		if (function_exists('sys_get_temp_dir')) return self::_normalizeDirectorySeparators(sys_get_temp_dir());

		if (!empty($_ENV['TMP'])) return self::_normalizeDirectorySeparators(realpath($_ENV['TMP']));
		else if (!empty($_ENV['TMPDIR'])) return self::_normalizeDirectorySeparators(realpath($_ENV['TMPDIR']));
		else if (!empty($_ENV['TEMP'])) return self::_normalizeDirectorySeparators(realpath($_ENV['TEMP']));
		else
		{
			$temp_file=tempnam(sha1(uniqid(rand(), true)), '');
			if ($temp_file)
			{
				$temp_dir=realpath(dirname($temp_file));
				unlink($temp_file);
				return self::_normalizeDirectorySeparators($temp_dir);
			}
			else return null;
       }
	}

	/**
	 * Returns true if the file in a given path has an extension.
	 *
	 * @param  string $path
	 * @return boolean
	 */
	public static function hasExtension($path)
	{
		$file=self::getFilename($path);
		$posDot=strrpos($file, ".");
		if ($posDot===false) return false;
		else return true;
	}

	/**
	 * Checks if the given path is rooted.
	 *
	 * Returns true on Unix machines if the path starts with '/'.
	 * Returns true on Windows machines if the path starts with
	 * '/', '\' or with '[A-Z]:'.
	 *
	 * @param  string $path
	 * @return boolean
	 */
	public static function isPathRooted($path)
	{
		$pos1=substr($path, 0, 1);

		if (self::_isWindows())
		{
			$pos2=substr($path, 1, 1);
			if ($pos1==self::getDirectorySeparator() ||
				$pos1==self::getAltDirectorySeparator() ||
				$pos2==self::getVolumeSeparator()) return true;
			else return false;
		}
		else
		{
			if ($pos1==self::getDirectorySeparator() ||
				$pos1==self::getAltDirectorySeparator()) return true;
			else return false;
		}
	}

	/**
	 * Resolves '..' and '.' in a given rooted path.
	 *
	 * If the given path is not rooted the path is returned unchanged.
	 *
	 * @param  string $path
	 * @return string
	 */
	public static function normalizePath($path)
	{
		$path=self::_normalizeDirectorySeparators($path);
		if (!self::isPathRooted($path)) return $path;
		$pathRoot=self::getPathRoot($path);
		$file=self::getFilename($path);
		if ($file!=='..' && $file!='.')
		{
			$trimmedPath=substr($path, strlen($pathRoot), -1*strlen($file));
		}
		else
		{
			$trimmedPath=substr($path, strlen($pathRoot));
			$file=null;
		}
		$parts=explode(self::getDirectorySeparator(), $trimmedPath);
		$resultStack=array();
		foreach ($parts as $p)
		{
			if ($p==='.' || empty($p)) continue;
			else if ($p==='..')
			{
				if (count($resultStack)>0) array_pop($resultStack);
				else return self::combine($pathRoot, $file);
			}
			else array_push($resultStack, $p);
		}
		$path=self::combine(implode(self::getDirectorySeparator(), $resultStack), $file);
		return self::combine($pathRoot, $path);
	}

	/**
	 * Sets the PHP include path to the given path(s).
	 * The method returns the old include path.
	 *
	 * Several arguments can be specified and will be assembled
	 * to the new include path in the order specified.
	 * Arguments can be strings or arrays of strings whereas
	 * arrays will be handled like multiple arguments.
	 *
	 * @param  string|array $path,...
	 * @return string
	 */
	public static function setIncludePath($path)
	{
	    if (func_num_args()==1) {
	        if (is_array($path)) $paths=$path;
            else $paths=array($path);
	    }
	    else {
	       $paths=array();
            foreach (func_get_args() as $arg) {
                if (is_array($arg)) $paths=array_merge($paths, $arg);
                else $paths[]=$arg;
            }
	    }
	    $includePath=implode(self::getPathSeparator(), $paths);
	    return set_include_path($includePath);
	}

	/**
     * Prepends the given path(s) to the current PHP include path.
     * The method returns the old include path.
     *
     * Several arguments can be specified and will be assembled
     * to the new include path in the order specified.
     * Arguments can be strings or arrays of strings whereas
     * arrays will be handled like multiple arguments.
     *
     * @param  string|array $path,...
     * @return string
     */
    public static function prependToIncludePath($path)
    {
        $paths=array();
        foreach (func_get_args() as $arg) {
            if (is_array($arg)) $paths=array_merge($paths, $arg);
            else $paths[]=$arg;
        }
        $paths[]=get_include_path();
        return self::setIncludePath($paths);
    }

    /**
     * Appends the given path(s) to the current PHP include path.
     * The method returns the old include path.
     *
     * Several arguments can be specified and will be assembled
     * to the new include path in the order specified.
     * Arguments can be strings or arrays of strings whereas
     * arrays will be handled like multiple arguments.
     *
     * @param  string|array $path,...
     * @return string
     */
    public static function appendToIncludePath($path)
    {
        $paths=array(get_include_path());
        foreach (func_get_args() as $arg) {
            if (is_array($arg)) $paths=array_merge($paths, $arg);
            else $paths[]=$arg;
        }
        return self::setIncludePath($paths);
    }

    /**
     * Checks if path is within the given root path.
     *
     * @param  string $path
     * @param  string $rootPath
     * @return boolean
     */
    public static function isWithinPath($path, $rootPath)
    {
        if (!self::isPathRooted($path)) return false;
        if (!self::isPathRooted($rootPath)) return false;

        $p1Last=substr($path, -1);
        if ($p1Last==self::getDirectorySeparator() || $p1Last==self::getAltDirectorySeparator())
            $path=substr($path, 0, -1);
        $p2Last=substr($rootPath, -1);
        if ($p2Last==self::getDirectorySeparator() || $p2Last==self::getAltDirectorySeparator())
            $rootPath=substr($rootPath, 0, -1);

        $rootPathLength=strlen($rootPath);
        $pathLength=strlen($path);
        if ($pathLength<$rootPathLength) return false;

        for ($i=0; $i<$rootPathLength; $i++) {

            if ($path[$i]!=$rootPath[$i]) {
                $isSep1=($rootPath[$i]==self::getDirectorySeparator() ||
                    $rootPath[$i]==self::getAltDirectorySeparator());
                $isSep2=($path[$i]==self::getDirectorySeparator() ||
                    $path[$i]==self::getAltDirectorySeparator());
                if (!$isSep1 || !$isSep2) return false;
            }
        }
        return true;
    }

    private static function _normalizeDirectorySeparators($path)
    {
        $path=str_replace('\\', self::getDirectorySeparator(), $path);
        $path=str_replace('/', self::getDirectorySeparator(), $path);
        return $path;
    }

    private static function _isWindows()
    {
        return (defined('PHP_OS') && stristr(PHP_OS, 'win'));
    }
}