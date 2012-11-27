<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexgustafson
 * Date: 11/25/12
 * Time: 3:05 PM
 * To change this template use File | Settings | File Templates.
 */

class Content extends CI_Controller {


  public function __construct()
  {
    parent::__construct();

    $this->load->library('contentdocument');
  }

  public function show( $id = 1)
  {
    if($id == 1 || $id == 'all' )
    {
      $id = 1;
    }
    $data['content'] = 'test';
    $data['content'] = $this->contentdocument->getTree($id);

    $this->load->view('templates/header', $data);
    //$this->load->view('content/show', $data);
    $this->load->view('templates/footer', $data);
  }




}