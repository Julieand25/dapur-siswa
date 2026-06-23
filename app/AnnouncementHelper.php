<?php

namespace App;

class AnnouncementHelper
{
    public static function renderContent(string $content): string
    {
        $lines = explode("\n", $content);
        $html = '';
        $inList = false;
        $listType = null;

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if (preg_match('/^(\d+)\.\s+(.+)$/', $trimmed, $m)) {
                if ($inList && $listType !== 'ol') {
                    $html .= '</ul>';
                    $inList = false;
                }
                if (! $inList) {
                    $html .= '<ol style="margin:0;padding-left:20px;">';
                    $inList = true;
                    $listType = 'ol';
                }
                $html .= '<li style="margin-bottom:4px;">'.e($m[2]).'</li>';
            } elseif (preg_match('/^-\s+(.+)$/', $trimmed, $m)) {
                if ($inList && $listType !== 'ul') {
                    $html .= '</ol>';
                    $inList = false;
                }
                if (! $inList) {
                    $html .= '<ul style="margin:0;padding-left:20px;">';
                    $inList = true;
                    $listType = 'ul';
                }
                $html .= '<li style="margin-bottom:4px;">'.e($m[1]).'</li>';
            } else {
                if ($inList) {
                    $html .= ($listType === 'ol' ? '</ol>' : '</ul>');
                    $inList = false;
                    $listType = null;
                }
                if ($trimmed !== '') {
                    $html .= '<p style="margin:0 0 6px 0;">'.e($trimmed).'</p>';
                }
            }
        }

        if ($inList) {
            $html .= ($listType === 'ol' ? '</ol>' : '</ul>');
        }

        return $html;
    }
}
