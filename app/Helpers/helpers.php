<?php

/**
 * Get a random value from an array.
 *
 * @param array $array
 * @param int   $numReq The amount of values to return
 *
 * @return mixed
 */
function array_rand_value(array $array, $numReq = 1)
{
    if (!count($array)) {
        return;
    }
    $keys = array_rand($array, $numReq);
    if ($numReq === 1) {
        return $array[$keys];
    }
    return array_intersect_key($array, array_flip($keys));
}