<?php

// requires phpredis extension see
// https://github.com/nicolasff/phpredis

class TokenStore {

  public function __construct(){
    $r = new Redis();
    $r->connect(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_HOST), parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PORT));
    if (!is_array(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS))) {
      $r->auth(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS));
    }
    $this->r = $r;
  }

  public function write($token){
    $this->r->set('token', $token);
  }
  public function read() {
    return $this->r->get('token');
  }
}