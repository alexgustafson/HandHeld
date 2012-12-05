<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 05.12.12
   * Time: 16:56
   * To change this template use File | Settings | File Templates.
   */
  class ContentType extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();

    }

    function index()
    {
      $this->load->model('Contenttype_model');
      $data['query'] = $this->Contenttype_model->getAll();
      $this->load->view('contenttype/show', $data);
    }
  }
