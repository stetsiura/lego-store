<?php

namespace Engine\Helper;

class Sanitize
{
    const STYLES_REGEX = '/(<[^>]+) style=".*?"/i';

    const NEWS_PREVIEW_LENGTH = 400;

    public static function removeStyles($input)
    {
        return preg_replace(self::STYLES_REGEX, '$1', $input);
    }

    public static function contentPreview($html)
    {
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->loadHTML(self::wrapHtml($html));
        $doc->encoding = 'utf-8';
        $text = trim(self::innerHtml($doc->documentElement, ''));

        if (mb_strlen($text, 'UTF-8') > self::NEWS_PREVIEW_LENGTH) {
            $text =  mb_substr($text, 0, self::NEWS_PREVIEW_LENGTH, 'UTF-8');
        }

        $lastSpaceIndex = mb_strrpos($text, ' ', null, 'UTF-8');

        if ($lastSpaceIndex) {
            $text = mb_substr($text, 0, $lastSpaceIndex, 'UTF-8');
        }

        $lastDotIndex = mb_strrpos($text, '.', null, 'UTF-8');

        if ($lastDotIndex) {
            $text = mb_substr($text, 0, $lastDotIndex, 'UTF-8');
        }

        return $text;
    }

    private static function wrapHtml($html) {
        return '<?xml encoding="utf-8"?>' . '<div>' . $html . '</div>';
    }

    private static function innerHtml($node, $text) {
        if (!is_null($node->childNodes)) {
            foreach ($node->childNodes as $node) {
                $text = self::innerHtml($node, $text);
            }
        }
        else {
            return $text . $node->textContent . ' ';
        }
        return $text;
    }
}