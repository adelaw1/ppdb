<?php

namespace App\Http\Controllers\MyLib;

class Form
{
  private $size_label;
  private $size_input;
  private $errors;
  private $link;

  public function set_size($label, $input)
  {
    $this->size_label = $label;
    $this->size_input = $input;
  }

  public function frm_open($action, $file = false, $method = "POST")
  {
    $this->link = "/" . explode("/", $action)[1];
    $return = '<form action="' . $action . '" method="' . $method . '"';
    if ($file) {
      $return .= 'enctype="multipart/form-data"';
    }
    $return .= ' autocomplete="off">';

    return $return;
  }

  public function frm_close()
  {
    return '</form>';
  }

  public function btn_save($back = true)
  {
    $return = '<hr /><div class="form-group row"><div class="col-12 text-right m-3"><div class="btn-group">';
    if ($back) {
      $return .= '<a href="' . $this->link . '" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i> Kembali</a>';
    }
    $return .= '<button type="submit" class="btn btn-sm btn-primary">Simpan <i class="fa fa-save"></i></button></div></div></div>';
    return $return;
  }

  public function btn_update($back = true)
  {
    $return = '<hr /><div class="form-group row"><div class="col-12 text-right m-3"><div class="btn-group">';
    if ($back) {
      $return .= '<a href="' . $this->link . '" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i> Kembali</a>';
    }
    $return .=  '<button type="submit" class="btn btn-sm btn-info">Update <i class="fa fa-refresh"></i></button></div></div></div>';
    return $return;
  }

  public function frm_text($name, $icon = "", $value = "", $attr = [])
  {
    return $this->description("text", $name, $icon, $value, "", false, $attr);
  }

  public function frm_file($name, $icon = "", $value = "", $attr = [])
  {
    return $this->description("file", $name, $icon, $value, "", false, $attr);
  }

  public function frm_tanggal($name, $icon = "", $value = "", $attr = [])
  {
    return $this->description("tanggal", $name, $icon, $value, "", false, $attr);
  }

  public function frm_password($name, $icon = "", $value = "", $attr = [])
  {
    return $this->description("password", $name, $icon, $value, "", false, $attr);
  }

  public function frm_number($name, $icon = "", $value = "", $attr = [])
  {
    return $this->description("number", $name, $icon, $value, "", false, $attr);
  }

  public function frm_textarea($name, $icon = "", $value = "", $attr = [])
  {
    return $this->description("textarea", $name, $icon, $value, "", false, $attr);
  }

  public function frm_select($name, $icon = "", $listData = [], $value = "", $attr = [])
  {
    return $this->description("select", $name, $icon, $value, $listData, false, $attr);
  }

  public function frm_mlselect($name, $icon = "", $listData = [], $value = [], $attr = [])
  {
    return $this->description("select", $name, $icon, $value, $listData, true, $attr);
  }

  public function frm_checkbox($name, $listData, $value = "", $attr = [])
  {
    return $this->description("checkbox", $name, "", $value, $listData, false, $attr);
  }

  public function frm_checkbox_l($name, $listData, $value = "", $attr = [])
  {
    return $this->description("checkbox", $name, "", $value, $listData, true, $attr);
  }

  public function frm_radio($name, $listData, $value = "", $attr = [])
  {
    return $this->description("radio", $name, "", $value, $listData, false, $attr);
  }

  public function frm_radio_l($name, $listData, $value = "", $attr = [])
  {
    return $this->description("radio", $name, "", $value, $listData, true, $attr);
  }

  private function description($type, $name, $icon = "", $value = "", $listData = "", $multiline = false, $attr = [])
  {
    $label = ucwords(str_replace("_", " ", $name));
    $return = '<div class="form-group row">
                    <label class="control-label col-md-' . $this->size_label . '" for="' . $name . '">' . $label . '</label>
                    <div class="col-md-' . $this->size_input . '">';
    $return .= ($icon ? '<div class="input-group">' : '');

    // Initialisasi input
    if ($type == "select") {
      $initial_input = $this->initial_select($name, $listData, $value, $multiline, $attr);
    } elseif ($type == "checkbox") {
      $initial_input = $this->initial_checkbox($name, $listData, $value, $multiline, $attr);
    } elseif ($type == "radio") {
      $initial_input = $this->initial_radio($name, $listData, $value, $multiline, $attr);
    } elseif ($type == "textarea") {
      $initial_input = $this->initial_textarea($name, $value, $attr);
    } else {
      $initial_input = $this->initial_global($type, $name, $value, $attr);
    }

    if ($icon) {
      $icon = explode("|", $icon);
      $posisi = end($icon);
      $div_icon = '<div class="' . ($posisi == "kanan" ? "input-group-prepend" : "input-group-prepend") . '">
                            <div class="input-group-text" id="button-' . $name . '">
                                <span class="fe fe-' . $icon[0] . ' fe-16"></span>
                            </div>
                        </div>';
      $return .= ($posisi == "kanan") ? $initial_input . $div_icon : $div_icon . $initial_input;
    } else {
      $return .= $initial_input;
    }


    if ($this->errors) {
      if ($this->errors->first($name)) {
        $return .= '<div class="invalid-feedback">' . $this->errors->first($name) . '</div>';
      }
    }
    $return .= ($icon ? '</div>' : '');
    $return .= '</div>
                </div>';

    return $return;
  }

  private function initial_select($name, $listData = [], $value = "", $multiline = false, $attr = [])
  {
    $return = '<select name="' . ($multiline ? $name . '[]' : $name) . '" id="' . $name . '" ' . ($multiline ? 'multiple="multiple"' : '') . ' class="form-control select2"';
    if ($attr) {
      foreach ($attr as $k => $v) {
        $return .= $k . '="' . $v . '" ';
      }
    }
    $return .= ">";
    $return .= ($multiline ? '' : '<option value="">- Pilih ' . ucwords(str_replace("_", " ", $name)) . ' -</option>');
    if ($listData) {
      foreach ($listData as $key => $val) {
        if ($multiline) {
          $value = ($value ? $value : []);
          $slt = (array_search($key, $value) === false) ? "" : "selected";
        } else {
          $slt = ($value == $key) ? "selected" : "";
        }

        $return .= '<option value="' . $key . '" ' . $slt . '>' . $val . '</option>';
      }
    }
    $return .= "</select>";

    return $return;
  }

  private function initial_checkbox($name, $listData, $value = "", $multiline = false, $attr = [])
  {
    $return = "<div>";
    foreach ($listData as $key => $val) {
      $value = ($value ? $value : []);
      $ck = (array_search($key, $value) === false) ? "" : "checked";
      $return .= ($multiline ? '<div class="clearfix">' : '');
      $return .= '<label><input type="checkbox" name="' . $name . '[]" value="' . $key . '" ' . $ck;
      if ($attr) {
        foreach ($attr as $k => $v) {
          $return .= $k . '="' . $v . '" ';
        }
      }
      $return .= ' /> ' . $val . '</label>';
      $return .= ($multiline ? '</div>' : '&nbsp;&nbsp;&nbsp;');
    }

    $return .= "</div>";

    return $return;
  }

  private function initial_radio($name, $listData, $value = "", $multiline = false, $attr = [])
  {
    $return = "";
    $class = "";
    if ($this->errors) {
      if ($this->errors->first($name)) {
        $class = " is-invalid";
      }
    }
    foreach ($listData as $key => $val) {
      $return .= '<div class="form-check ' . ($multiline ? "" : "form-check-inline") . $class . '">';
      $ck = ($key == $value) ? "checked" : "";
      $return .= '<input type="radio" name="' . $name . '" id="' . $key . '" value="' . $key . '"
                            class="form-check-input' . $class . '" ' . $ck;
      if ($attr) {
        foreach ($attr as $k => $v) {
          $return .= $k . '="' . $v . '" ';
        }
      }
      $return .= ' /> <label for="' . $key . '" class="form-check-label">' . $val . '</label>';
      $return .= '</div>';
    }

    return $return;
  }

  private function initial_textarea($name, $value = "", $attr = [])
  {
    $class = "form-control ";
    if ($this->errors) {
      if ($this->errors->first($name)) {
        $class .= "is-invalid";
      }
    }
    $return = '<textarea name="' . $name . '" id="' . $name . '" class="' . $class . '" ';
    if ($attr) {
      foreach ($attr as $k => $v) {
        $return .= $k . '="' . $v . '" ';
      }
    }
    $return .= '>' . $value . '</textarea>';

    return $return;
  }

  private function initial_global($type, $name, $value = "", $attr = [])
  {
    $label = ucwords(str_replace("_", " ", $name));
    $return = "";
    $class = "form-control ";
    if ($this->errors) {
      if ($this->errors->first($name)) {
        $class .= "is-invalid ";
      }
    }
    if ($type == "tanggal") {
      $class .= "input-group date ";
    }
    if ($type == "file") {
      $cls = "";
      if ($this->errors) {
        if ($this->errors->first($name)) {
          $cls = ' is-invalid';
        }
      }
      $return .= '<div class="custom-file' . $cls . '">';
      $class .= "custom-file-input ";
    }

    $return .= '<input type="' . ($type == "tanggal" ? "text" : $type) . '" class="' . $class . '"' .  ($type == "tanggal" ? "data-date-format='yyyy-mm-dd'" : "") . ' name="' . $name . '" id="' . $name . '" value="' . $value . '" placeholder="' . $label . '" ';
    if ($attr) {
      foreach ($attr as $k => $v) {
        $return .= $k . '="' . $v . '" ';
      }
    }
    $return .= ' />';

    if ($type == "file") {
      $return .= '<label for="' . $name . '" class="custom-file-label">Upload ' . $label . '</label>
                        </div>';
    }

    return $return;
  }

  public function push_error($errors)
  {
    $this->errors = $errors;
  }
}
