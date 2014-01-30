<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.8.0 (2013-03-18)
 * @info $Id: Language.class.php 2801 2013-10-05 23:55:41Z slaver7 $
 * @link http://2moons.cc/
 */

class Language implements ArrayAccess
{
    private $container = array();
    private $language = array();
    static private $allLanguages = array();
	
	static function getAvailableLanguages($onlyKeys = true)
	{
		if(empty(self::$allLanguages))
		{
			$cache	= Cache::get();
			$cache->add('language', 'LanguageBuildCache');
			self::$allLanguages = $cache->getData('language');
		}
		
		if($onlyKeys)
		{
			return array_keys(self::$allLanguages);
		}
		else
		{
			return self::$allLanguages;
		}
	}
	
	public function getUserAgentLanguage()
	{
   		if (isset($_REQUEST['lang']) && in_array($_REQUEST['lang'], self::getAvailableLanguages()))
		{
			HTTP::sendCookie('language', $_REQUEST['lang'], 2147483647);
			$this->setLanguage($_REQUEST['lang']);
			return true;
		}
		
   		if ((MODE === 'LOGIN' || MODE === 'INSTALL') && in_array(HTTP::getCookie('language'), self::getAvailableLanguages()))
		{
			$this->setLanguage($_COOKIE['lang']);
			return true;
		}
		
	    if (empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
            return false;
        }

        $accepted_languages = preg_split('/,\s*/', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

        $language = $this->getLanguage();

        foreach ($accepted_languages as $accepted_language)
		{
			$isValid = preg_match('!^([a-z]{1,8}(?:-[a-z]{1,8})*)(?:;\s*q=(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3})?))?$!i', $accepted_language, $matches);

			if ($isValid !== 1)
			{
				continue;
			}

            list($code)	= explode('-', strtolower($matches[1]));

			if(in_array($code, self::getAvailableLanguages()))
			{
				$language	= $code;
				break;
			}
        }

        HTTP::sendCookie('language', $language, 2147483647);
		$this->setLanguage($language);

		return $language;
	}
	
    public function __construct($language = NULL)
	{
		$this->setLanguage($language);
    }
	
    public function setLanguage($language)
	{
		if(!is_null($language) && in_array($language, self::getAvailableLanguages()))
		{
			$this->language = $language;
		}
		elseif(MODE !== 'INSTALL')
		{
			$this->language	= Config::get()->lang;
		}
		else
		{
			$this->language	= DEFAULT_LANG;
		}
    }
	
    public function addData($data) {
		$this->container = array_replace_recursive($this->container, $data);
    }
	
	public function getLanguage()
	{
		return $this->language;
	}
	
	public function getTemplate($templateName)
	{
		if(file_exists('language/'.$this->getLanguage().'/templates/'.$templateName.'.txt'))
		{
			return file_get_contents('language/'.$this->getLanguage().'/templates/'.$templateName.'.txt');
		}
		else
		{
			return '### Template "'.$templateName.'" on language "'.$this->getLanguage().'" not found! ###';
		}
	}
	
	public function includeData($files)
	{
		// Fixed BOM problems.
		ob_start();
		$LNG	= array();

		$path	= 'language/'.$this->getLanguage().'/';

        foreach($files as $file) {
			$filePath	= $path.$file.'.php';
			if(file_exists($filePath))
			{
				require $filePath;
			}
		}

		$filePath	= $path.'CUSTOM.php';
		require $filePath;
		ob_end_clean();

		$this->addData($LNG);
	}

    static public function createHumanReadableList($data, $lastWord = NULL)
    {
        if(is_null($lastWord))
        {
            global $LNG;
            $lastWord   = $LNG['d_and'];
        }

        $string = '';
        $count  = count($data);
        $i = 0;
        foreach($data as $name => $value)
        {
			$value	= is_numeric($value) ? pretty_number($value) : $value;

            if($i++ == $count)
            {
                $string .= $lastWord.' '.$value.' '.$name;
            }
			else
			{
				$string .= $value.' '.$name.' ';
			}
        }

        return $string;
    }
	
	/** ArrayAccess Functions **/
	
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
	
    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
	
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
	
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : $offset;
    }
}