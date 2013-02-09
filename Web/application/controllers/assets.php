<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexgustafson
 * Date: 2/8/13
 * Time: 9:19 PM
 * To change this template use File | Settings | File Templates.
 */

class Assets extends CI_Controller{

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

    $this->load->view('partials/header', $data);
    $this->load->view('partials/leftmenu', $data);
    $this->load->view('assets/partials/contentheader', $data);
    $this->load->view('assets/index.php', $data);
    $this->load->view('partials/footer', $data);
  }

  /**
   * This callback function is called by elfinder whenever files are manipulated
   *
   * @param  string   $cmd       command name
   * @param  array    $result    command result
   * @param  array    $args      command arguments from client
   * @param  object   $elfinder  elFinder instance
   * @return void|true
   **/
  public function fileManagerLog($cmd, $result, $args, $elfinder)
  {
    $log = $cmd.' ['.date('d.m H:s')."]\n";

    if (!empty($result['error'])) {
      $log .= "\tERROR: ".implode(' ', $result['error'])."\n";
    }

    if (!empty($result['warning'])) {
      $log .= "\tWARNING: ".implode(' ', $result['warning'])."\n";
    }

    if (!empty($result['removed'])) {
      foreach ($result['removed'] as $file) {
        // removed file contain additional field "realpath"
        $log .= "\tREMOVED: ".$file['realpath']."\n";
        $this->db->where('realpath',$file['realpath']);
        $this->db->delete('files');
      }
    }

    if (!empty($result['added'])) {
      foreach ($result['added'] as $file) {
        $log .= "\tADDED: ".$elfinder->realpath($file['hash'])."\n";
        $data = array('realpath' => $elfinder->realpath($file['hash']));
        $this->db->insert('files', $data);
      }
    }

    if (!empty($result['changed'])) {
      foreach ($result['changed'] as $file) {
        $log .= "\tCHANGED: ".$elfinder->realpath($file['hash'])."\n";
      }
    }

  }


  function elfinder_ini()
  {

    $this->load->helper('path');
    $opts = array(
      // 'debug' => true,
      'accessControl' => 'access',
      'roots' => array(
        array(
          'driver' => 'LocalFileSystem',
          'path'   => set_realpath('uploads'),
          'URL'    => site_url('uploads') . '/'
          // more elFinder options here
        )
      ),
      'bind' => array(
        'mkdir mkfile rename duplicate upload rm paste' => array($this, 'fileManagerLog')
      )

    );
    $this->load->library('elfinder_lib', $opts);
  }

}