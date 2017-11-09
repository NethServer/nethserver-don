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
 
namespace NethServer\Module\NethSos;
use Nethgui\System\PlatformInterface as Validate;

class Stop extends \Nethgui\Controller\AbstractController 
{
    public function initialize()
    {
        $self = $this;
        $sessionIdAdapter = $this->getPlatform()->getMapAdapter(function()use($self){
            $contents = file('/run/nethsos/credentials');
            return trim($contents[1]);
        });
        parent::initialize();
        $this->declareParameter('ServerId', FALSE, array('configuration', 'nethupdate', 'SystemID'));
        $this->declareParameter('SessionId', FALSE, $sessionIdAdapter);
        $this->declareParameter('SessionExpire', FALSE);
    }
    
    public function process()
    {
        if($this->getRequest()->isMutation()) {
            $this->getPlatform()->signalEvent('nethsos-stop &');
        }
        parent::process();
    }
    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        if($this->getRequest()->isValidated()) {
             $view->getCommandList()->show();
        }
    }
    public function nextPath()
    {
        if($this->getRequest()->isMutation()) {
            return 'Start';
        }
        return FALSE;
    }
}
