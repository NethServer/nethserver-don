<?php

echo $view->header()->setAttribute('template',$T('NethSos_Start_header'));

// echo $view->slider('SessionDuration')->setAttribute('min', 1)->setAttribute('max', 31);

echo $view->buttonList()
    ->insert($view->button('Start', $view::BUTTON_SUBMIT))
    ->insert($view->button('Help', $view::BUTTON_HELP))
;
