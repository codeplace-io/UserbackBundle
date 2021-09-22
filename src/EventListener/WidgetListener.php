<?php
declare(strict_types=1);

namespace Codeplace\UserbackBundle\EventListener;

use Codeplace\UserbackBundle\Service\WidgetRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class WidgetListener implements EventSubscriberInterface
{
    private bool $inject;
    private WidgetRenderer $widgetRenderer;

    public function __construct(bool $inject, WidgetRenderer $widgetRenderer)
    {
        $this->inject = $inject;
        $this->widgetRenderer = $widgetRenderer;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse', -128],
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $this->injectWidget($event->getResponse());
    }

    private function injectWidget(Response $response): void
    {
        if (!$this->inject) {
            return;
        }

        $content = $response->getContent();

        if (!is_string($content)) {
            return;
        }

        $pos = strripos($content, '</body>');

        if (false !== $pos) {
            $widget = "\n".str_replace("\n", '', $this->widgetRenderer->renderWidgetScript())."\n";
            $content = substr($content, 0, $pos).$widget.substr($content, $pos);
            $response->setContent($content);
        }
    }
}
