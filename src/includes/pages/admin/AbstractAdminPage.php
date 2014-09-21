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
 * @version 2.0.0 (2015-01-01)
 * @info $Id: AbstractGamePage.php 2793 2013-09-29 12:33:56Z slaver7 $
 * @link http://2moons.cc/
 */

require 'includes/classes/AbstractPage.php';

abstract class AbstractAdminPage extends AbstractPage
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = Session::get()->getUser();
    }

	protected function assignFullPageData()
    {
		$config	= Config::get();

        $this->assign(array(
			'authlevel'			=> $this->user->authlevel,
			'userID'			=> $this->user->id,
			'bodyclass'			=> $this->getWindow(),
            'gameName'		    => $config->game_name,
            'uniName'		    => $config->uni_name,
			'debug'				=> $config->debug,
			'VERSION'			=> $config->VERSION,
			'date'				=> explode("|", date('Y\|n\|j\|G\|i\|s\|Z', TIMESTAMP)),
			'REV'				=> substr($config->VERSION, -4),
			'Offset'			=> $this->user->getServerTimeDifference(),
			'queryString'		=> $this->getQueryString(),
			'themeSettings'		=> $THEME->getStyleSettings(),
		));
	}

	protected function assignBasicData()
    {
        $this->assign(array(
            'lang'    		=> Session::get()->getUser()->getLangObj(),
            'basePath'		=> PROTOCOL.HTTP_HOST.HTTP_BASE,
            'sessionId'		=> SID
        ));
	}
}