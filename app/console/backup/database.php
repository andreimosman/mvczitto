<?php
/**
 * This is a *** DUMMY *** exemple of a command line script that can be used to backup uploaded files.
 */

/**
 * As in the controllers and models, the bootstrapped resources is available through $MVCzitto. 
 * 
 * For example. If you bootstrapped a PDO object as 'db', you can use it in the command line script as:
 * $MVCzitto->db;
 * 
 * $MVCzitto->config and $MVCzitto->models are also available.
 * 
 */

 /**
  * 
  * if you throw an MVCzitto\Application\ConsoleApplicationUsageException, the script will print the usage and exit.
  * if there is a file with this same name and the extension .help, it will be printed.
  *
  * 
  */

use MVCzitto\Application\ConsoleApplicationUsageException;

throw new ConsoleApplicationUsageException("This is a dummy command line script that can be used to backup uploaded files.");

/**
 * 
 * if you thrown any other unhandled exception, the script will print the message and exit.
 * (don't forget to comment the exception above if you want to text the exception bellow)
 * =)
 */

// throw new Exception("This is a general exception. It will be printed and the script will exit.");