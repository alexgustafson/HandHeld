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
    $this->load->model('content_model');
  }

  public function getContentTable( )
  {

    $data['content'] = $this->content_model->getContent();
    $data['title'] = ucfirst($page); // Capitalize the first letter

    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer', $data);
  }

  public function displayContent( )
  {

    $data['content'] = $this->content_model->getContent();
    $data['title'] = ucfirst($page); // Capitalize the first letter

    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer', $data);
  }


}