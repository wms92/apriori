<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_AdminController extends CI_Controller {
    protected $user = null;
    public $callAdm;
    function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user');
        if(empty($this->user)) {
          redirect('./');
        } else {
          $this->user = (object) $this->user;
        }
        $this->callAdm = $this;
    }

    public function tesFungsi() {
      $this->user->nohp = "tes";
      return $this;
    }

}
