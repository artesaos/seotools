<?php

return [
    'meta' => array(
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => array(
            'title'       => false,
            'description' => false,
            'separator'   => ' - ',
            'keywords'    => [],
        ),

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => array(
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null
        )
    )
];