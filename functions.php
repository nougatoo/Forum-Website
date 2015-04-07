<?php
/**
 * Description of functions
 * This php will initialize the database for us and if there's anything that's redundant,
 * we can just keep adding those codes in here, aka the default stuff.
 * @author Ryan
 */
    session_start();

    static $db;
    date_default_timezone_set("UTC");
    if($db === NULL){
        initialize();
    }

    function initialize()
    {
        global $db;
        $db = new mysqli('zeeveener.com', 'collier', 'rox', 'collier');

        //Check if the database is connected
        if ($db->connect_errno > 0)
        {
            //Kill, cause we can't connect
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        
    }
    
    function close()
    {
        /*
         * This doesn't fully work.
         * You can now have more than one tab open, which will use the same session
         * But closing all the tabs doesn't destroy the session
         */
        
        //Check if the window is closed
        if (CONNECTION_ABORTED == 1)
        {
            //Destroy session
            session_unset();
            session_destroy();
        }
    }
    
    function loguser()
    {
        session_unset();
        session_destroy();
    }
    
?>