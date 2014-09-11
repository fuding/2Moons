<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan
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
 * @author Jan <info@2moons.cc>
 * @copyright 2006 Perberos <ugamela@perberos.com.ar> (UGamela)
 * @copyright 2008 Chlorel (XNova)
 * @copyright 2012 Jan <info@2moons.cc> (2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 2.0.0.$Revision: 2242 $ (2012-11-31)
 * @info $Id: ShowScreensPage.class.php 2803 2013-10-06 22:23:27Z slaver7 $
 * @link http://2moons.cc/
 */


class ShowScreensPage extends AbstractIndexPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show() 
	{
		$images	= array();
		$directoryIterator = new DirectoryIterator('styles/resource/images/login/screens/');
        foreach ($directoryIterator as $fileInfo)
		{
			/** @var $fileInfo DirectoryIterator */
			if (!$fileInfo->isFile())
			{
				continue;
            }			

			$fileName	= $fileInfo->getFilename();

			$thumbnail	= 'styles/resource/images/login/screens/'.$fileName;
			if(file_exists('styles/resource/images/login/screens/thumbnails/'.$fileName))
			{
				$thumbnail = 'styles/resource/images/login/screens/thumbnails/'.$fileName;
			}
			
			$images[]	= array(
				'path' 		=> 'styles/resource/images/login/screens/'.$fileName,
				'thumbnail' => $thumbnail,
			);
		}
		
		$this->assign(array(
			'images' => $images
		));

		$this->display('page.screens.default');
	}
}