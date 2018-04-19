<?php

namespace Darsalud\Http\Controllers;

use App;
use Auth;
use Config;
use Crypt;
use Darsalud\User;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Session\SessionManager;

class WebSocketController  implements MessageComponentInterface{
  protected $clients;

   public function __construct() {
       $this->clients = new \SplObjectStorage;
   }

   public function onOpen(ConnectionInterface $conn) {
       // Store the new connection to send messages to later
       $this->clients->attach($conn);
       $this->connections[$conn->resourceId] = compact('conn') + ['user_id' => null];
       $session = (new SessionManager(App::getInstance()))->driver();
       $cookies = $conn->httpRequest->getHeader('Cookie');
       $cookies= urldecode($cookies[0]);
       $laravelCookie = explode(';',$cookies);
     if(count($laravelCookie)==1):
       $laravelCookie = explode('=',$cookies);
       //dd($cookies);
       //dd(Config::get('session.cookie'));
     else:
       $laravelCookie=$laravelCookie[7];
       $laravelCookie = explode('=',$laravelCookie);
     endif;
       //dd($laravelCookie);
       $laravelCookie=$laravelCookie[1];
       $idSession = Crypt::decrypt($laravelCookie);
       //dd($idSession);
       $session->setId($idSession);
       // Bind the session handler to the client connection
       $conn->session = $session;
       echo "New connection! ({$conn->resourceId})\n";
   }

   public function onMessage(ConnectionInterface $conn, $msg) {
       $conn->session->start();
       $idUser = $conn->session->get(Auth::getName());
        if (!isset($idUser)) {
          echo "El usuario no esta logeado de manera correcta";
        } else {
          $currentUser = User::find($idUser);
        }
        if(is_null($this->connections[$conn->resourceId]['user_id'])){
            $this->connections[$conn->resourceId]['user_id'] = $msg;
            $onlineUsers = [];
            foreach($this->connections as $resourceId => &$connection){
                $connection['conn']->send(json_encode([$conn->resourceId => $msg]));
                if($conn->resourceId != $resourceId)
                    $onlineUsers[$resourceId] = $connection['user_id'];
            }
            $conn->send(json_encode(['online_users' => $onlineUsers]));
        } else{
            $fromUserId = $this->connections[$conn->resourceId]['user_id'];
            $msg = json_decode($msg, true);
            $this->connections[$msg['to']]['conn']->send(json_encode([
                'msg' => $msg['content'],
                'from_user_id' => $fromUserId,
                'from_resource_id' => $conn->resourceId
            ]));
        }

    // or you can save data to the session
    $conn->session->put('foo', 'bar');
    // ...
    // and at the end. save the session state to the store
    $conn->session->save();

      }

   public function onClose(ConnectionInterface $conn) {
       // The connection is closed, remove it, as we can no longer send it messages
       $this->clients->detach($conn);

       echo "Connection {$conn->resourceId} has disconnected\n";
   }

   public function onError(ConnectionInterface $conn, \Exception $e) {
       echo "An error has occurred: {$e->getMessage()}\n";

       $conn->close();
   }
}
