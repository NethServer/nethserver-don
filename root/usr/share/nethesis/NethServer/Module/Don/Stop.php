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

namespace NethServer\Module\Don;
use Nethgui\System\PlatformInterface as Validate;

class Stop extends \Nethgui\Controller\AbstractController
{
    public function initialize()
    {
        $self = $this;
        $sessionIdAdapter = $this->getPlatform()->getMapAdapter(function()use($self){
            $version = $self->getPlatform()->getDatabase('configuration')->getProp('sysconfig','Version');
            if (strpos($version, "6") == 0) {
                 $cred_file = '/var/run/don/credentials';
            } else {
                 $cred_file = '/run/don/credentials';
            }
            if (file_exists($cred_file)) {
                $contents = file($cred_file);
                return trim($contents[1]);
            } else {
                return '';
            }
        });
        parent::initialize();
        $this->declareParameter('SystemId', Validate::ANYTHING, array('configuration', 'don', 'SystemId'));
        $this->declareParameter('SessionId', Validate::ANYTHING, $sessionIdAdapter);
    }

    public function process()
    {
        if($this->getRequest()->isMutation()) {
            $this->getPlatform()->signalEvent('nethserver-don-stop');
        }
        parent::process();
    }
    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $ipaddr = $this->getPlatform()->exec("/sbin/ip -o -4 address show tunDON primary | head -1 | awk '{print \$4}' | cut -d '/' -f1")->getOutput();
        $view['IpAddr'] = $ipaddr;
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
