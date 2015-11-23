<?php

    require_once('cliente.php');

    $show_values = new Cliente();
    // Insert and show Values
    if(isset($_POST['envia'])){

        // If submit form inservalue and show values
        $show_values->insertValue();
        $show_values->showValue();

    }else{ // Remove values when click on delete trash icon
        $id_request = preg_replace('(id)','',$_REQUEST['id']); //id sin id caracteres
        $show_values->removeValue($id_request);
        $show_values->showValue();
    }


