<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Post;
use App\Models\User;
use MoonShine\Components\Card;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Components\Title;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        $postsCount = Post::query()->count();
        $usersCount = User::query()->count();

        return [
            Title::make('Статистика сайта', 2),

            Card::make(
                title: 'Посты',
                values: [
                    'Всего постов' => (string) $postsCount,
                ],
            ),
        ];
    }
}
