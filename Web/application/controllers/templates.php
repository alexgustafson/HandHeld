<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex_gustafson
 * Date: 27.01.13
 * Time: 17:45
 * To change this template use File | Settings | File Templates.
 */

class Templates extends CI_Controller {

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
    $this->load->view('templates/partials/contentheader', $data);
    $this->load->view('templates/index.php', $data);
    $this->load->view('partials/footer', $data);
  }

  public function edit($id)
  {
    $data['fields'] = $this->Template_model->get_all_field_types();
    $data['templates'] = $this->Template_model->get_all_templates();
    $this->load->helper('Optimus');

    if ($id == 'cancel')
    {
      redirect(base_url() . 'templates/');
    }

    if($id != null && $id != 'new')
    {
      $template = $this->Template_model->get_template($id);
      $data['template'] = $template;
      $sections = $this->Template_model->get_all_children_fields($id);

      $partials = array();
      foreach($sections as $section ){
        array_push($partials, create_partial($section ));
      }
      $data['sections'] = $partials;

    }

    if (!$_POST)
    {
      //no post data so get document to edit and serve the 'Edit' partial
      $data['action'] = 'Edit';

      $this->load->view('partials/header', $data);
      $this->load->view('partials/leftmenu', $data);
      $this->load->view('templates/partials/contentheader', $data);
      $this->load->view('templates/index.php', $data);
      $this->load->view('partials/footer', $data);

    } else
    {
      //post data is available, so save it. Then serve the 'Overview' template
      $data['articles'] = $this->Article_model->get_all_articles();
      $data['action'] = 'Overview';

      $this->load->view('partials/header', $data);
      $this->load->view('partials/leftmenu', $data);
      $this->load->view('templates/partials/contentheader', $data);
      $this->load->view('templates/index.php', $data);
      $this->load->view('partials/footer', $data);
    }
  }




}