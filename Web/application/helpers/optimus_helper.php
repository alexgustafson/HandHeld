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

  if(isset($data[$field->name]))
  {
     $value = $data[$field->name];
  }

  switch ($field->field_type_name) {
    case "text":

      $snippet = '<div class="control-group">
							      <label class="control-label">'. $field->name .'</label>
							      <div class="controls">
								      <input type="text" class="span6" value="'. $value.'" name="data['. $field->name .']">
							      </div>
							    </div>';

      break;
    case "resource_path":

      break;
    case "html_text":

      break;
    case "longitude":

      break;
  }

  return $snippet;
}