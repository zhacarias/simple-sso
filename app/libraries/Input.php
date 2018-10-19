<?php

namespace App\Libraries;

/**
 * Class Input
 *
 * @package \App\Libraries
 */
class Input
{
    public static function clean($input)
    {
        $badtags = [
            '/<script>(.*?)<\/script>/'
        ];

        $clean = strip_tags($input);
        $clean = str_replace(['.exe', 'DROP', 'DELETE', 'SLEEP('], '', $clean);
        $clean = str_replace("'", "''", $clean);
        $clean = preg_replace($badtags, '$1', $clean);

        return $clean;
    }
}
