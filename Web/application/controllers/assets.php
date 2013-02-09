<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexgustafson
 * Date: 2/8/13
 * Time: 9:19 PM
 * To change this template use File | Settings | File Templates.
 */

class Assets extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Document_model');
    $this->load->model('Article_model');
    $this->load->model('Template_model');
  }

  public function index($action = null)
  {

    $data['action'] = 'Overview';

    $data['documents'] = $this->Document_model->get_all_documents();

    $this->load->view('partials/header', $data);
    $this->load->view('partials/leftmenu', $data);
    $this->load->view('assets/partials/contentheader', $data);
    $this->load->view('assets/index.php', $data);
    $this->load->view('partials/footer', $data);
  }


  function elfinder_init()
  {
    $this->load->helper('path');
    $opts = array(
      // 'debug' => true,
      'roots' => array(
        array(
          'driver' => 'LocalFileSystem',
          'path'   => set_realpath('uploads'),
          'URL'    => site_url('uploads') . '/'
          // more elFinder options here
        )
      )
    );
    $this->load->library('elfinder_lib', $opts);
  }

}