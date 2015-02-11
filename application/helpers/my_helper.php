<?php
function getValueOfListForm($list, $key1 = 0, $key2 = 0)
{
    if (isset($list[$key1][$key2])) {
        return $list[$key1][$key2];
    } elseif (isset($list[$key1])) {
        return $list[$key1];
    } else {
        return false;
    }
}