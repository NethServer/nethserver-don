<?php


if ( $view['SystemId'] ) {
    echo $view->header()->setAttribute('template',$T('Don_Start_header'));
    
    echo $view->textInput('SystemId', $view::STATE_DISABLED | $view::STATE_READONLY);

    echo $view->buttonList()
        ->insert($view->button('Start', $view::BUTTON_SUBMIT))
        ->insert($view->button('Help', $view::BUTTON_HELP))
;
} else {
    echo $view->header()->setAttribute('template',$T('Don_noconfig_header'));
    echo '<div class="notification bg-yellow noconfig"><p>'.$T('Noconfig_label').'</p>'.
         '<p><a href="https://github.com/NethServer/nethserver-don/blob/master/README.md">'.$T('Manual_label').'</a></p></div>';

}
