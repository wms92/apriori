<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
  * kumpulan fungsi yang bikin gampang
  */
if ( ! function_exists('dd'))
{
  function dd($value) {
    var_dump($value);
    exit();
  }

  function status_kendaraan($idKendaraan) {
    switch($idKendaraan) {
      case 0:
        return 'Idle';
        break;

      case 1:
        return 'Booking';
        break;

      case 2:
        return 'Dipakai';
        break;
    }
  }
}
