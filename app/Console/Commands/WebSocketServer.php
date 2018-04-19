<?php

namespace Darsalud\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Darsalud\Http\Controllers\WebSocketController;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializar servidor Websocket para recibir y administrar conexiones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $server = IoServer::factory(
         new HttpServer(
             new WsServer(
                 new WebSocketController()
             )
         ),
         8090
      );
      try {
          $server->run();
      } catch(\Exception $e) {
          Tool::log('An error has occurred: {' . $e->getMessage() . '}', 'fatal');
      }
    }
}
