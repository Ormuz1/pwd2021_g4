<?php
require_once("websocket_base.php");

class ContadorUsuarios extends WebSocketServer
{
    protected $contadorUsuarios;

    function __construct($addr, $port, $bufferLength) {
        parent::__construct($addr, $port, $bufferLength);
        $this->contadorUsuarios = 0;
    }
    protected function connected($user)
    {
        $this->contadorUsuarios++;
        foreach($this->users as $u)
        {
            $this->send($u, $this->contadorUsuarios);
        }
    }

    protected function process($user, $message)
    {
        
    } 
      
      protected function closed ($user) {
        $this->contadorUsuarios--;
        foreach($this->users as $u)
        {
            $this->send($u, $this->contadorUsuarios);
        }
      }
}


$websocketServer = new ContadorUsuarios("localhost", "8090", 2048);

try
{
    $websocketServer->run();
}
catch(Exception $e)
{
    $websocketServer->stdout($e->getMessage());
}
