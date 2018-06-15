<?php

class View {
    
    public function render($tpl, $pageData) {
        include ROOT . $tpl;
    }
}

 ?>
