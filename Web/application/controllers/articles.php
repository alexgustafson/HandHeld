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
    $this->load->model('Template_model');
    $this->load->model('Assets_model');

  }

  public function index($action = null)
  {

    $data['action'] = 'Overview';

    $data['articles'] = $this->Article_model->get_all_articles();


    $this->load->view('partials/header', $data);
    $this->load->view('partials/leftmenu', $data);
    $this->load->view('articles/partials/contentheader', $data);
    $this->load->view('articles/index.php', $data);
    $this->load->view('partials/footer', $data);
  }

  public function build($id = null)
  {

    $data['action'] = 'Build';

    if($id != null && $id != 'new')
    {
      $data['articles'] = $this->Article_model->get_article_by_id($id);

      $article = $this->Article_model->get_article_by_id($id);
      $article = $article[0];

      $data['template_panels'] = $this->create_panel_for_template($article->template_id);
    }

    $data['templates'] = $this->Template_model->get_all_templates();

    $this->load->view('partials/header', $data);
    $this->load->view('partials/leftmenu', $data);
    $this->load->view('articles/partials/contentheader', $data);
    $this->load->view('articles/index.php', $data);
    $this->load->view('partials/footer', $data);

  }

  public function edit($id)
  {
    if ($id == 'cancel')
    {
      redirect(base_url() . 'articles/');
    }

    $data['images'] = $this->Assets_model->get_all_images();

    if($id != null && $id != 'new')
    {
      $data['articles'] = $this->Article_model->get_article_by_id($id);

      $article = $this->Article_model->get_article_by_id($id);
      $article = $article[0];

      $data['template_panels'] = $this->create_panel_for_template($article->template_id, $article->data);
    }

    if (!$_POST)
    {
      //no post data so get document to edit and serve the 'Edit' template
      $data['action'] = 'Edit';
      $data['articles'] = $this->Article_model->get_article_by_id($id);
      $data['templates'] = $this->Template_model->get_all_templates();

      $this->load->view('partials/header', $data);
      $this->load->view('partials/leftmenu', $data);
      $this->load->view('articles/partials/contentheader', $data);
      $this->load->view('articles/index.php', $data);
      $this->load->view('partials/footer', $data);

    } else
    {
      //post data is available, so save it. Then serve the 'Overview' template
      $data['articles'] = $this->Article_model->get_all_articles();
      $data['action'] = 'Overview';

      $this->load->view('partials/header', $data);
      $this->load->view('partials/leftmenu', $data);
      $this->load->view('articles/partials/contentheader', $data);
      $this->load->view('articles/index.php', $data);
      $this->load->view('partials/footer', $data);
    }
  }

  public function update()
  {
    if ($_POST)
    {
      $this->Article_model->set_article();

      //post data is available, so save it. Then serve the 'Overview' template
      $data['articles'] = $this->Article_model->get_all_articles();
      $data['action'] = 'Overview';

      $this->load->view('partials/header', $data);
      $this->load->view('partials/leftmenu', $data);
      $this->load->view('articles/partials/contentheader', $data);
      $this->load->view('articles/index.php', $data);
      $this->load->view('partials/footer', $data);
    }
  }

  public function create_panel_for_template_ajax($template_id)
  {
    $this->load->model('Template_model');
    $fields = $this->Template_model->get_fields_for_template($template_id);

    echo json_encode($fields);
  }

  public function create_panel_for_template($template_id, $data = null)
  {
    $this->load->helper('Optimus');
    $this->load->model('Template_model');
    $fields = $this->Template_model->get_fields_for_template($template_id);

    if($data)
    {
      $data = json_decode($data);
    }

    $template_fields = array();
    $i = 0;
    foreach($fields as $field)
    {
      if(isset($data->{$field->id})){
        $template_fields[$i] = create_html_for_field($field, $data->{$field->id});
      }else{
        $template_fields[$i] = create_html_for_field($field);
      }

      $i++;
    }

    return $template_fields;
  }



}