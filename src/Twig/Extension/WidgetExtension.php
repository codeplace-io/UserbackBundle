<?php
declare(strict_types=1);

namespace Codeplace\UserbackBundle\Twig\Extension;

use Codeplace\UserbackBundle\Service\WidgetRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class WidgetExtension extends AbstractExtension
{
    private WidgetRenderer $widgetRenderer;

    public function __construct(WidgetRenderer $widgetRenderer)
    {
        $this->widgetRenderer = $widgetRenderer;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'userback_widget',
                [$this->widgetRenderer, 'renderWidgetScript'],
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }
}
