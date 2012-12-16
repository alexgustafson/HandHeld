<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alexgustafson
   * Date: 11/25/12
   * Time: 3:05 PM
   * To change this template use File | Settings | File Templates.
   */

  class Dashboard extends CI_Controller {

    public function __construct()
    {
      parent::__construct();

    }

    public function index( $page='home' )
    {

      if ( ! file_exists('application/views/pages/'.$page.'.php'))
      {
        // Whoops, we don't have a page for that!
        show_404();
      }

      $data['title'] = ucfirst($page); // Capitalize the first letter

      $this->load->view('templates/header', $data);
      $this->load->view('templates/leftmenu', $data);
      $this->load->view('templates/contentheader', $data);
      $this->load->view('pages/'.$page, $data);
      $this->load->view('templates/footer', $data);
    }
  }