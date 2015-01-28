<?php
function getMenuList($data, $parent = 0, $text = '', $selected = 0)
{
    foreach ($data as $key => $item) {
        if ($item['pc_parentid'] == $parent) {
            $id = $item['pc_id'];

            if ($id == $selected && $selected != 0) {
                echo '<option selected value="'.$item['pc_id'].'">'.$text . ' ' . $item['pc_name'].'</option>';
            } else {
                echo '<option value="'.$item['pc_id'].'">'.$text . ' ' . $item['pc_name'].'</option>';
            }
            unset($data[$key]);
            getMenuList($data, $id, $text.'--' , $selected);
        }
    }
}