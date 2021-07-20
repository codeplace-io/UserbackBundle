<?php
declare(strict_types=1);

namespace Codeplace\UserbackBundle\Service;

use Twig\Environment;

final class WidgetRenderer
{
    private Environment $twig;
    private bool $enabled;
    private string $accessToken;

    public function __construct(bool $enabled, string $accessToken, Environment $twig)
    {
        $this->twig = $twig;
        $this->enabled = $enabled;
        $this->accessToken = $accessToken;
    }

    public function renderWidgetScript(): string
    {
        return $this->twig->render(
            '@CodeplaceUserback/widget_script.html.twig',
            [
                'enabled' => $this->enabled,
                'accessToken' => $this->accessToken,
            ]
        );
    }
}
