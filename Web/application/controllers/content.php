<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexgustafson
 * Date: 11/4/12
 * Time: 11:38 PM
 * To change this template use File | Settings | File Templates.
 */

  class Content extends CI_Controller {


    public function index()
    {
      $this->load->view('welcome_message');
    }

    public function create()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $data['title'] = 'Create a news item';

      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('text', 'text', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $this->load->view('templates/header', $data);
        $this->load->view('news/create');
        $this->load->view('templates/footer');

      }
      else
      {
        $this->news_model->set_news();
        $this->load->view('news/success');
      }
    }
  }
