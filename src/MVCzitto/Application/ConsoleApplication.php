<?php

namespace MVCzitto\Application;

use \Exception;
use MVCzitto\DependencyInjector;

class ConsoleApplication extends Application
{

    protected $consolePath;
    protected $commands = [];

    public function run()
    {

        $parameters = $_SERVER['argv'];

        $app = null;
        $command = null;

        try
        {
            if( count($parameters) > 0 ) $app = array_shift($parameters);

            if( !count($parameters) ) throw new ConsoleApplicationUsageException("No command specified.");
            $command = array_shift($parameters);

            if( !$this->isValidCommand($command) ) 
            {

                $commands = $this->getCommands($command);

                throw new ConsoleApplicationUsageException("Invalid command specified.");

            }

            $this->execute($command, $parameters);
    
        }
        catch( ConsoleApplicationUsageException $e )
        {
            $this->printUsage($command, $e->getMessage());
            return false;
        } 
        catch( Exception $e )
        {
            echo $e->getMessage();
            echo "\n";
            return false;
        }

        try
        {
            
        } 
        catch(Exception $e)
        {

        }

    }

    protected function isValidCommand($command)
    {

        $this->loadCommands(); // Ensure commands are loaded

        return isset($this->commands[$command]);

    }

    protected function printUsage($command = null, $errorMessage = null)
    {

        $strCommand = $this->isValidCommand($command) ? $command : '<command>';

        $app = @$_SERVER['argv'][0] ?? './cli';

        if( !count( $this->getCommands() ) )
        {
            echo "\nNo commands available.\n\n";
            return;
        }

        if( $errorMessage ) echo "\n$errorMessage\n";

        echo "\nUsage:\n\n    $app $strCommand [<parameters>]\n\n";

        if( $this->isValidCommand($command) )
        {
            $help = $this->getHelp($command);

            if( $help ) echo "\n$help\n";

        }

        if( !$this->isValidCommand($command) ) {

            $commands = $this->getCommands($command); // Filtered commands
            if( $command && !count($commands) ) $commands = $this->getCommands(); // All commands
    
            if( count($commands) )
            {
    
                echo "\nAvailable commands:\n\n";
                foreach($commands as $command)
                {
                    echo "    $command\n";
                }
                echo "\n\n";
    
                return false;
    
            }

        }


    }

    protected function getConsolePath()
    {
        if( $this->consolePath ) return $this->consolePath;

        $this->consolePath = $this->config->app->paths->console ?? 'console';
        if( "/" != substr($this->consolePath, 0, 1) )
        {
            $this->consolePath = APP_PATH . '/' . $this->consolePath;
        }

        return $this->consolePath;

    }

    protected function loadCommands($folder = null)
    {

        if( !$folder )
        {

            if( count($this->commands) ) return true; // Already set

            $this->commands = []; // Initialize

        }

        if( !is_null($folder) && "/" == substr($folder, 0, 1) ) $folder = substr($folder, 1);

        $fullPath = $this->getConsolePath() . "/" . $folder;

        $dd = opendir($this->getConsolePath() . "/" . $folder);

        while( $file = readdir($dd) )
        {
            
            if( $file == '.' || $file == '..' ) continue;
            if( is_dir($fullPath . '/' . $file) ) 
            {
                $this->loadCommands($folder . '/' . $file);
                continue;
            }

            $info = pathinfo($fullPath . '/' . $file);

            if( filesize($fullPath . '/' . $file) < 1 ) continue; // Ignore empty files

            if( @$info['extension'] == 'php' )
            {
                $this->commands[$folder . "/" . $info['filename']] = true;
            }

        }

        closedir($dd);

    }

    protected function getCommands($folder = null)
    {

        $this->loadCommands();
        if( is_null($folder) ) return array_keys( $this->commands );

        return array_filter(array_keys($this->commands), function($command) use ($folder) {
            return strpos($command, $folder . "/") === 0;
        });

    }

    protected function getHelp($command = null)
    {
        $consolePath = $this->getConsolePath();


        if( $this->isValidCommand($command) && file_exists($consolePath . "/" . $command . ".help") )
        {
            return file_get_contents($consolePath . "/" . $command . ".help");
        }

        return "";

    }

    protected function execute($command, $parameters)
    {
        if( !$this->isValidCommand($command) ) throw new ConsoleApplicationUsageException("Invalid command specified.");

        $fileToLoad = $this->getConsolePath() . "/" . $command . ".php";

        call_user_func(function() use ($fileToLoad, $parameters){

            $MVCzitto = DependencyInjector::getInstance();
            $_PARAMETERS = $parameters;

            include($fileToLoad);

        });

    }

}
