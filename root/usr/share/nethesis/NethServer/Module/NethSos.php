<?php 

/*
 * Copyright (C) 2017 Nethesis S.r.l.
 * http://www.nethesis.it - nethserver@nethesis.it
 *
 * This script is part of NethServer.
 *
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License,
 * or any later version.
 *
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see COPYING.
 */
 
namespace NethServer\Module;
 
class NethSos extends \Nethgui\Controller\CompositeController 
{
    protected function initializeAttributes(\Nethgui\Module\ModuleAttributesInterface $base)
    {
        return \Nethgui\Module\SimpleModuleAttributesProvider::extendModuleAttributes($base, 'Management', 0);
    }
    public function initialize()
    {
        parent::initialize();
        if(file_exists('/run/nethsos/credentials')) {
            $this->addChild(new NethSos\Stop());
            $this->addChild(new NethSos\Start());
        } else {
            $this->addChild(new NethSos\Start());
            $this->addChild(new NethSos\Stop());
        }
    }
    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $isRegistered = $this->getPlatform()->getDatabase('configuration')->getProp('nethupdate', 'SystemID');
        if( ! $isRegistered && ! file_exists('/run/nethsos/credentials')) {
            header('Location: ' . $view->getModuleUrl('/Register'));
            exit(0);
        }
    }
}
