<?php
class Nav {
  public function nav () {
    $nav_links = [
      'links' => [
        ['url' => '/', 'name' => 'Usuarios'],
        ['url' => '/registrar', 'name' => 'Registrar'],
        ['url' => '/menus', 'name' => 'Menús'],
        ['url' => '/modulos', 'name' => 'Módulos']
      ]
    ];
    return $nav_links;
  }
}
