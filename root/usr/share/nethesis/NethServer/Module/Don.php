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

class Don extends \Nethgui\Controller\CompositeController
{
    protected function initializeAttributes(\Nethgui\Module\ModuleAttributesInterface $base)
    {
        return \Nethgui\Module\SimpleModuleAttributesProvider::extendModuleAttributes($base, 'Management', 0);
    }
    public function initialize()
    {
        parent::initialize();
        $status = $this->getPlatform()->exec('sudo /usr/bin/don status')->getExitCode();

        if ($status == 6) { // not running
            $this->addChild(new Don\Start());
            $this->addChild(new Don\Stop());
        } else if( $status == 0) { // everything ok
            $this->addChild(new Don\Stop());
            $this->addChild(new Don\Start());
        } else {
            $this->addChild(new Don\Start());
        }
    }
    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $systemid = $this->getPlatform()->getDatabase('configuration')->getProp('don', 'SystemId');
        $view['SystemId'] = $systemid;
    }
}
