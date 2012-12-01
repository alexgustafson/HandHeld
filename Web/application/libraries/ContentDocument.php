<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alexgustafson
   * Date: 11/27/12
   * Time: 8:58 PM
   * To change this template use File | Settings | File Templates.
   */
  class ContentDocument
  {

    var $recursionLevel = 0;
    var $recursionLimit = 10;


    public function __construct()
    {

      $this->load->database();
      $this->load->model('content_model');
    }

    public function getTree($id = 1)
    {
      $data['content'] = $this->content_model->getContent($id);
      $data['content']['children'] = getChildren($data['content']);
    }

    public function getChildren($node)
    {
      $roots = getRoots();
    }

    public function getRoots()
    {

    }


  }
