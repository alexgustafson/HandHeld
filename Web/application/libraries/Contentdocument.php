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
      $data['content']['nodes'] = $this->getRoots($data['content']);
    }

    public function getChild($node)
    {
        return $this->content_model->getContent($node['child_id']);
    }

    public function getRoots($parent)
    {
      $nodes = $this->node_model->getNodesForParent($parent['id']);
      foreach($nodes as $node);
      {
        $node['child'] = $this->getChild($node);
      }
      return $nodes;
    }






  }
