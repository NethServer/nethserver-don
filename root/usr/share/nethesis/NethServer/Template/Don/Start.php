<?php


if ( $view['SystemId'] ) {
    echo $view->header()->setAttribute('template',$T('Don_Start_header'));
    
    echo '<div class="notification don_description noconfig"><p>'.$T('Start_description').'</p></div>';

    echo "<div><span class='don_label'>".$T('ServerName_label').":</span>"; echo $view->textLabel('ServerName'); echo " </div>";
    echo "<div class='don_spacer'></div>";
    echo $view->buttonList()
        ->insert($view->button('Start', $view::BUTTON_SUBMIT))
        ->insert($view->button('Help', $view::BUTTON_HELP))
;
} else {
    echo $view->header()->setAttribute('template',$T('Don_noconfig_header'));
    echo '<div class="notification bg-yellow noconfig"><p>'.$T('Noconfig_label').'</p>'.
         '<p><a href="https://github.com/NethServer/nethserver-don/">'.$T('Manual_label').'</a></p></div>';

}

$view->includeCss("
div.don_spacer {
    height: 10px;
}

span.don_label {
    font-weight: bold;
    margin-right: 10px;
    font-size: larger;
}

div.don_description {
    background-color: #eee;
    border-color: #eee;
    margin: 10px;
    padding: 10px;
    width: 50%;
}

");
