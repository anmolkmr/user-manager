<?php
function jsAlert($message, $href)
{
    echo "<script type='application/javascript'>
                alert('$message');
                window.location.href='$href';
               </script>";
}

