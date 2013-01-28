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
      $this->load->model('Article_model');
      $this->load->model('Template_model');
    }

    public function index($action = null)
    {

      $data['action'] = 'Overview';

      $data['documents'] = $this->Document_model->get_all_documents();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/leftmenu', $data);
      $this->load->view('documents/templates/contentheader', $data);
      $this->load->view('documents/index.php', $data);
      $this->load->view('templates/footer', $data);
    }

    public function create($action = null)
    {

      if (!$_POST)
      {
        $data['action'] = 'Create';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/leftmenu', $data);
        $this->load->view('documents/templates/contentheader', $data);
        $this->load->view('documents/index.php', $data);
        $this->load->view('templates/footer', $data);
      } else
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

    public function edit($id)
    {
      if ($id == 'cancel')
      {
        redirect(base_url() . 'documents/');
      }

      if (!$_POST)
      {
        //no post data so get document to edit and serve the 'Edit' template
        $data['action'] = 'Edit';
        $data['documents'] = $this->Document_model->get_document_by_id($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/leftmenu', $data);
        $this->load->view('documents/templates/contentheader', $data);
        $this->load->view('documents/index.php', $data);
        $this->load->view('templates/footer', $data);

      } else
      {
        //post data is available, so save it. Then serve the 'Overview' template
        $data['documents'] = $this->Document_model->set_document();
        $data['action'] = 'Overview';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/leftmenu', $data);
        $this->load->view('documents/templates/contentheader', $data);
        $this->load->view('documents/index.php', $data);
        $this->load->view('templates/footer', $data);
      }
    }

    public function delete($id = null)
    {
      $data['documents'] = $this->Document_model->delete_document($id);
      redirect(base_url() . 'documents/');
    }

    public function build($id = null)
    {
      $data['action'] = 'Build';
      $data['documents'] = $this->Document_model->get_document_by_id($id);

      //load all articles
      $data['articles'] = $this->Article_model->get_all_articles();
      $data['templates'] = $this->Template_model->get_all_template();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/leftmenu', $data);
      $this->load->view('documents/index.php', $data);
      $this->load->view('templates/footer', $data);
    }

    public function modify()
    {

      $document_id = $this->input->post('document_id');
      $action = $this->input->post('action');
      $startArticleID = $this->input->post('startArticleID');

      if($action == 'setStartArticle')
      {
        $document = $this->Document_model->set_startArticle_for_document($startArticleID, $document_id);
      }elseif($action == 'create_and_setStartArticle')
      {
        $article = $this->Article_model->set_article();
        $document = $this->Document_model->set_startArticle_for_document($article->id, $document_id);
        redirect(base_url() . 'documents/build/'.$document->id);
      }

      redirect(base_url() . 'documents/build/'.$document_id);

    }

  }
