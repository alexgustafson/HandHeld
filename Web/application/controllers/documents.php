<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 16.12.12
   * Time: 14:32
   * To change this template use File | Settings | File Templates.
   */

  class Documents extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('Document_model');

    }

    public function index( $action = null )
    {

      $data['action'] = 'Overview';

      $data['documents'] = $this->Document_model->get_all_documents();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/leftmenu', $data);
      $this->load->view('documents/templates/contentheader', $data);
      $this->load->view('documents/index.php', $data);
      $this->load->view('templates/footer', $data);
    }

    public function create( $action = null )
    {

      if(!$_POST)
      {
        $data['action'] = 'Create';
        $data['documents'] = $this->Document_model->get_all_documents();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/leftmenu', $data);
        $this->load->view('documents/templates/contentheader', $data);
        $this->load->view('documents/index.php', $data);
        $this->load->view('templates/footer', $data);
      }else
      {
        $data['action'] = 'Overview';
        $data['documents'] = $this->Document_model->set_document();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/leftmenu', $data);
        $this->load->view('documents/templates/contentheader', $data);
        $this->load->view('documents/index.php', $data);
        $this->load->view('templates/footer', $data);
      }



    }
  }
