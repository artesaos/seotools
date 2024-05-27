<?php

declare(strict_types=1);

namespace Artesaos\SEOTools\Integrations;

final class Inertia
{
    public function convertHeadToInertiaStyle(string $seo)
    {
        $pattern = '/<(meta|script|title|link)/';
        $replacement = '<$1 inertia';

        return preg_replace($pattern, $replacement, $seo);
    }
}