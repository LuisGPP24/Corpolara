<?php
function array_some($array, $callback)
{
    foreach ($array as $item) {
        if ($callback($item)) {
            return true;
        }
    }
    return false;
}