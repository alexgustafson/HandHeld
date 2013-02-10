<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 28.01.13
   * Time: 18:13
   * To change this template use File | Settings | File Templates.
   */

  function create_html_for_field($field, $data = null)
  {

    $snippet = "";
    $value = "";

    if (isset($data))
    {
      $value = $data;
    }

    if (!isset($field->children))
    {
      $name = 'data[' . $field->id . ']';
      $snippet = create_snippet($name, $field, $value);

    } else
    {
      $snippet = '<div class="box">
                  <div class="box-header">
                    <h2><span class="break"></span>' . $field->name . '</h2>
                    <div class="box-icon">
                      <input type="hidden" name="fields[]" value="' . $field->id . '">

                    </div>
                  </div>
                  <div class="box-content">';

      foreach ($field->children as $key => $child)
      {
        $name = 'data[' . $field->id . ']'.'[' . $child->id . ']';
        if(isset($data->{$child->id})){
          $snippet = $snippet . create_snippet($name, $child, $data->{$child->id});
        }else{
          $snippet = $snippet . create_snippet($name, $child, "");
        }

      }

      $snippet = $snippet . '</div></div>';

    }

    return $snippet;

  }

  function create_snippet($name, $field, $value)
  {
    $CI =& get_instance();
    $snippet = '';
    switch ($field->field_type_name)
    {
      case "text":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
								      <input type="text" class="span6" value="' . $value . '" name="'.$name.'">
							      </div>
							    </div>';

        break;
      case "resource_path":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
							        <input type="text" class="span6" value="' . $value . '" name="'.$name.'">
								      <button class="btn btn-mini btn-select-file">Select Image</button>
								      <div>
								      <img src="' . $value . '" alt="' . $field->name . '">
								      </div>
							      </div>
							    </div>';

        break;
      case "html_text":

        break;

      case "number":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
								      <input type="text" class="span6" value="' . $value . '" name="'.$name.'">
							      </div>
							    </div>';

        break;
      case "color":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
								      <input type="text" class="color" style="background-color:' . $value . '" name="'.$name.'" value="' . $value . '" />
								      <button class="btn btn-mini btn-choose-color">Color</button>
                      <div class="colorpicker" style="display: none;"></div>
							      </div>
							    </div>';

        break;

      case "link_to_article":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">';

        $snippet = $snippet . '<select id="selectError3" name="'.$name.'">';

        $CI->load->model('Article_model');
        $articles = $CI->Article_model->get_all_articles();
        foreach($articles as $article){


          if($article->id == $value)
          {
            $snippet = $snippet . '<option value="' . $article->id . '" selected>' . $article->name . '  |  ' . $article->id . '</option>';
          }else
          {
            $snippet = $snippet . '<option value="' . $article->id . '">' . $article->name . '  |  ' . $article->id . '</option>';
          }
        }

        $snippet = $snippet . '</select>';
        $snippet = $snippet . '</div>
							    </div>';

        break;

      case "image":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
							        <input type="text" class="span6" value="' . $value . '" name="'.$name.'">
								      <button class="btn btn-mini btn-select-file">Select Image</button>
								      <img src="' . $value . '" alt="' . $field->name . '">
							      </div>
							    </div>';

        break;

      case "html_text":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
								        <textarea class="cleditor" id="textarea2" name="'.$name.'" rows="6">'. $value .'</textarea>
							      </div>
							      </div>';

        break;
    }


    return $snippet;
  }


  function create_partial($field)
  {
    $snippet = "";
    $value = "";

    if (isset($field->children))
    {

      $snippet = '<div class="box">
                  <div class="box-header">
                    <h2><i class="icon-align-justify"></i><span class="break"></span>' . $field->name . '</h2>
                    <div class="box-icon">
                      <input type="hidden" name="fields[]" value="' . $field->id . '">
                      <a href="#" class="btn-remove"><i class="icon-remove"></i></a>
                    </div>
                  </div>
                  <div class="box-content">';

      foreach ($field->children as $child)
      {
        $snippet = $snippet . ' <div class="box">
                                <div class="box-header">
                                <h2><i class="icon-align-justify"></i><span class="break"></span>' . $child->name . '</h2>
                                  <div class="box-icon">
                                  </div>
                                </div>
                              </div>';


      }

      $snippet = $snippet . '</div></div>';

    } else
    {


      $snippet = '<div class="box">
                  <div class="box-header">
                    <h2><i class="icon-align-justify"></i><span class="break"></span>' . $field->name . '</h2>
                    <div class="box-icon">
                      <input type="hidden" name="fields[]" value="' . $field->id . '">
                      <a href="#" class="btn-remove"><i class="icon-remove"></i></a>
                    </div>
                  </div>
                </div>';


    }


    return $snippet;

  }