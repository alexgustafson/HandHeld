<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex_gustafson
 * Date: 27.01.13
 * Time: 17:45
 * To change this template use File | Settings | File Templates.
 */

class Articles extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Article_model');
    $this->load->model('Fieldtype_model');

  }

  public function index($action = null)
  {

    $data['action'] = 'Overview';

    $data['articles'] = $this->Article_model->get_all_articles();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/leftmenu', $data);
    $this->load->view('articles/templates/contentheader', $data);
    $this->load->view('articles/index.php', $data);
    $this->load->view('templates/footer', $data);
  }

  public function build($id = null)
  {

    $data['action'] = 'Build';

    $data['articles'] = $this->Article_model->get_article_by_id($id);
    $data['article_types'] = $this->Article_model->get_all_article_types();

      $this->load->view('templates/header', $data);
    $this->load->view('templates/leftmenu', $data);
    $this->load->view('articles/templates/contentheader', $data);
    $this->load->view('articles/index.php', $data);
    $this->load->view('templates/footer', $data);
  }

}