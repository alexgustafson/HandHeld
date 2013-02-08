<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex_gustafson
 * Date: 27.01.13
 * Time: 17:45
 * To change this template use File | Settings | File Templates.
 */

class Media extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Article_model');
    $this->load->model('Template_model');

  }

  public function index($action = null)
  {

    $data['action'] = 'Overview';

    $data['templates'] = $this->Template_model->get_all_templates();


    $this->load->view('partials/header', $data);
    $this->load->view('partials/leftmenu', $data);
    $this->load->view('media/partials/contentheader', $data);
    $this->load->view('media/index.php', $data);
    $this->load->view('partials/footer', $data);
  }








}