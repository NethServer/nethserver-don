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

class Start extends \Nethgui\Controller\AbstractController
{
    public function initialize()
    {
        parent::initialize();
        $this->declareParameter('SessionDuration', $this->createValidator()->greatThan(0)->lessThan(32));
    }
    public function process()
    {
        if($this->getRequest()->isMutation()) {
            $status = $this->getPlatform()->exec('/usr/bin/don status')->getExitCode();

            if ($status != 6 && $status != 0) { // a problem occured
                $this->getPlatform()->signalEvent('nethserver-don-stop');
            }

            $this->getPlatform()->signalEvent('nethserver-don-start');
        }
        parent::process();
    }
    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $systemid = $this->getPlatform()->getDatabase('configuration')->getProp('don', 'SystemId');
        $view['SystemId'] = $systemid;
        if($this->getRequest()->isValidated()) {
             $view->getCommandList()->show();
        }
    }
    public function nextPath()
    {
        if($this->getRequest()->isMutation()) {
            $status = $this->getPlatform()->exec('/usr/bin/don status')->getExitCode();
            if ($status == 0) {
                return 'Stop';
            } else {
                return 'Start';
            }
        }
        return FALSE;
    }
}
