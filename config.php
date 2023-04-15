<?php
    $db = mysqli_connect("sql300.epizy.com","epiz_34014436","Ralg5555#","epiz_34014436_main");
    $base = dirname($_SERVER['PHP_SELF']);

    function p_hash($x){
        return password_hash($x,PASSWORD_DEFAULT);
    }
    function p_ver($x,$y){
        return password_verify($x,$y);
    }
    //date_default_timezone_set('Asia/Kolkata');
    //echo date('d M, Y')." at ".date('g:i A');
    if($db === false){
        die("Connection Error: ".$db->connect_error);
    }
    header('Cache-Control: no-store, no-cache, must-revalidate, private');
    function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        if(file_exists($filePath)){
            // Extract the variables to a local namespace
            extract($variables);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;

    }
?>