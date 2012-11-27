<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alexgustafson
   * Date: 11/27/12
   * Time: 8:58 PM
   * To change this template use File | Settings | File Templates.
   */
  class Contentdocument extends CI_Controller
  {

    var $recursionLevel = 0;
    var $recursionLimit = 10;


    public function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->model('content_model');
      $this->load->model('node_model');
    }

    public function getTree($id = 1)
    {
      $data['content'] = $this->content_model->getContent($id);
      $data['content']['nodes'] = $this->getChildren($data['content']);
    }

    public function getChildren($parent)
    {
      $nodes = $this->node_model->getNodesForParent($parent['id']);
      return $nodes;
    }

    public function getRoots()
    {

    }


  }
