<?php
/**
 * Description of functions
 * This php will initialize the database for us and if there's anything that's redundant,
 * we can just keep adding those codes in here, aka the default stuff.
 * @author Ryan
 */
    
    //mysqli('host', 'user', 'password', 'database');
     $db = new mysqli('zeeveener.com', 'collier', 'rox', 'collier');
    //Check if the database is connected
    if ($db->connect_errno > 0)
    {
        //Kill, cause we can't connect
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    else
    {
        print('<br>Database Connected<br>');
    }
    

    //Start a session
    session_start();

        

    function close()
    {
        //Check if the window is closed
        if (CONNECTION_ABORTED==1)
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