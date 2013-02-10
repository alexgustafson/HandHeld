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

    if (isset($data->value))
    {
      $value = $data->value;
    }

    if (!isset($field->children))
    {
      $snippet = create_snippet($field, $value);

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

      foreach ($field->children as $child)
      {
        $snippet = $snippet . create_snippet($child, $value);
      }

      $snippet = $snippet . '</div></div>';

    }

    return $snippet;

  }

  function create_snippet($field, $value)
  {
    $snippet = '';
    switch ($field->field_type_name)
    {
      case "text":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
								      <input type="text" class="span6" value="' . $value . '" name="data[' . $field->id . ']">
							      </div>
							    </div>';

        break;
      case "resource_path":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
							        <input type="text" class="span6" value="' . $value . '" name="data[' . $field->id . ']">
								      <button class="btn btn-mini btn-select-file">Select Image</button>
							      </div>
							    </div>';

        break;
      case "html_text":

        break;

      case "number":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
								      <input type="text" class="span6" value="' . $value . '" name="data[' . $field->id . ']">
							      </div>
							    </div>';

        break;

      case "image":

        $snippet = '<div class="control-group">
							      <label class="control-label">' . $field->name . '</label>
							      <div class="controls">
							        <input type="text" class="span6" value="' . $value . '" name="data[' . $field->id . ']">
								      <button class="btn btn-mini btn-select-file">Select Image</button>
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