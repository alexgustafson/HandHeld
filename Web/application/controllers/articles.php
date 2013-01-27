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
    $data['article_types'] = $this->Article_model->get_all_templates();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/leftmenu', $data);
    $this->load->view('articles/templates/contentheader', $data);
    $this->load->view('articles/index.php', $data);
    $this->load->view('templates/footer', $data);

  }

  public function edit($id)
  {
    if ($id == 'cancel')
    {
      redirect(base_url() . 'articles/');
    }

    if (!$_POST)
    {
      //no post data so get document to edit and serve the 'Edit' template
      $data['action'] = 'Edit';
      $data['articles'] = $this->Article_model->get_article_by_id($id);
      $data['article_types'] = $this->Article_model->get_all_templates();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/leftmenu', $data);
      $this->load->view('articles/templates/contentheader', $data);
      $this->load->view('articles/index.php', $data);
      $this->load->view('templates/footer', $data);

    } else
    {
      //post data is available, so save it. Then serve the 'Overview' template
      $data['articles'] = $this->Article_model->get_all_articles();
      $data['action'] = 'Overview';

      $this->load->view('templates/header', $data);
      $this->load->view('templates/leftmenu', $data);
      $this->load->view('articles/templates/contentheader', $data);
      $this->load->view('articles/index.php', $data);
      $this->load->view('templates/footer', $data);
    }
  }

  public function create_panel_for_template($template_id)
  {
    $this->load->model('Template_model');
    $fields = $this->Template_model->get_fields_for_template($template_id);

    echo json_encode($fields);
  }

}