<?php

$_parseJSON = function($str) {
    return \json_decode($str);
};

if (!isset($GLOBALS['__Purs_Undefined'])) {
    $GLOBALS['__Purs_Undefined'] = new \stdClass();
}
$_undefined = $GLOBALS['__Purs_Undefined'];

$_stripUndefined = function($val) use (&$_stripUndefined, $_undefined) {
    if (is_array($val)) {
        if (array_is_list($val)) {
            $result = [];
            foreach ($val as $v) {
                if ($v === $_undefined) {
                    $result[] = null;
                } else {
                    $result[] = $_stripUndefined($v);
                }
            }
            return $result;
        } else {
            $result = [];
            $hasElements = false;
            foreach ($val as $k => $v) {
                if ($v !== $_undefined) {
                    $result[$k] = $_stripUndefined($v);
                    $hasElements = true;
                }
            }
            if (!$hasElements) return new \stdClass();
            return $result;
        }
    }
    if (is_object($val) && !($val instanceof \Closure)) {
        if ($val === $_undefined) return $val;
        $result = clone $val;
        $hasElements = false;
        foreach ($val as $k => $v) {
            if ($v === $_undefined) {
                unset($result->$k);
            } else {
                $result->$k = $_stripUndefined($v);
                $hasElements = true;
            }
        }
        return $result;
    }
    return $val;
};

$_unsafeStringify = function($val) use ($_stripUndefined) {
    return \json_encode($_stripUndefined($val));
};

$exports['_parseJSON'] = $_parseJSON;
$exports['_undefined'] = $_undefined;
$exports['_unsafeStringify'] = $_unsafeStringify;

return $exports;
