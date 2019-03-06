<?php
namespace Drupal\fashion_subscribe_users\Controller;

use Drupal\Core\Controller\ControllerBase;

class FashionSubscribeUsersController extends ControllerBase
{
  public function content(){
      return [
          '#theme' => 'display_fashion_subscribe_users',
          '#usercontent' =>  'form',
      ];
  }
}
