<?php

$_parseJSON = function($str) {
    return \json_decode($str);
};

$_undefined = null;

$_unsafeStringify = function($val) {
    return \json_encode($val);
};

$exports['_parseJSON'] = $_parseJSON;
$exports['_undefined'] = $_undefined;
$exports['_unsafeStringify'] = $_unsafeStringify;

return $exports;
