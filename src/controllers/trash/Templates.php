<?php
class Templates {
  private $m;
  private $nav;
  public function __construct(){
    $this->m = (new \Mustache_Engine(
      [
        'partials_loader' => new \Mustache_Loader_FilesystemLoader('src/views/partials'),
      ]
    ));
    $this->nav = new Nav();
  }
  public function render($template, $data) {
    $template = @file_get_contents('src/views/pages/' . $template . '.html');
    if($template === false) {
      $template = file_get_contents('src/views/pages/404.html');
    }
    return $this->m->render($template, $data);
  }

  public function getPageURL() {
    $url = explode('?', $_SERVER['REQUEST_URI']);
    return  ($url[0] == '/' ? '/home' : $url[0]);
  }

  public function data ($page) {
    $data['nav']['nav_links'] = $this->nav->nav();
    $page_name = substr($page, 1);
    $page_title = ucfirst($page_name);
    $base_title = 'Registro - '.$page_title;
    $data['data'] = [
      'title' => $base_title,
      'norma' => 'public/css/index.css',
      'jquery' => 'public/js/jquery-3.7.1.min.js',
      'style' => 'public/css/pages/' . $page_name . '.css',
      'script' => 'src/views/js/' . $page_name . '.js'

    ];
    return $data;
  }
}
