<?php

echo $view->header()->setAttribute('template',$T('Don_Stop_header'));

$SessionId = $view->getUniqueId('SessionId');

echo $view->textInput('ServerId', $view::STATE_DISABLED | $view::STATE_READONLY);

$labelOpenTag = "<label for='$SessionId'>";

$help = '<div class="dcalert notification bg-yellow">
  <p>' . $labelOpenTag . '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . htmlspecialchars($T('SessionHelp_label')) . '</label></p>
</div>';

//echo $view->textInput('SessionExpire', $view::STATE_DISABLED | $view::STATE_READONLY);
echo $view->textInput('SessionId', $view::STATE_DISABLED | $view::STATE_READONLY);
echo $help;

echo $view->buttonList()
    ->insert($view->button('Stop', $view::BUTTON_SUBMIT))
    ->insert($view->button('Help', $view::BUTTON_HELP))
;

$view->includeCss("
#Don_Stop .TextInput {
    width: 30em;
}

.dcalert {
    color: #000;
    background-color: #FFB600;
    border: 1px solid #FFB600;
    border-radius: 2px;
    padding: 15px;
    margin: 10px;
    position: relative;
}

.dcalert:before {
  content: '';
  position: absolute;
  bottom: 100%;
  left: 20px;
  width: 0;
  border-bottom: 18px solid #FFB600;
  border-left: 18px solid transparent;
  border-right: 18px solid transparent;
}

.notification.bg-yellow {color: #000; background-color: #FFB600; border-color: #FFB600 }
.notification.bg-yellow a {color: #000}


.dcalert ul {
    list-style-type: disc;
    margin-left: 25px;
}

");
