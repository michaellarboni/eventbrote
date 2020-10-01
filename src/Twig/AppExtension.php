<?php

namespace App\Twig;

use App\Entity\Event;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;


class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('pluralize', [$this, 'pluralize']),
            new TwigFunction('formatPrice', [$this, 'formatPrice']),
        ];
    }

    // ?string $plural = null signifie optionel et par defaut null
    public function pluralize(int $count, string $singular, ?string $plural = null): string
    {
        $plural = $plural ?? $singular . 's';

        // si $count vaut 1, $string vaut $singular sinon $plural
        $str = $count === 1 ? $singular : $plural;

        return "$count $str";
    }

    public function formatPrice(Event $event): string
    {
        if ($event->isFree()) {
            return 'FREE!';
        }

        return $event->getPrice() . '€';

    }
}
