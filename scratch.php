<?php
call_user_func(function() {
    if (!class_exists('__Purs_Undefined')) {
        class __Purs_Undefined {}
    }
});
$x = new \__Purs_Undefined();
echo "Success\n";
