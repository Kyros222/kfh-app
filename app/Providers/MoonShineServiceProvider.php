<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CompletedOrdersResource;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\OrdersInProcessResource;
use App\MoonShine\Resources\PostResource;
use App\MoonShine\Resources\RejectedOrdersResource;
use App\MoonShine\Resources\ServiceResource;
use Closure;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Pages\Page;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [
            new PostResource,
            new OrderResource,
            new ServiceResource,
        ];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuItem::make('Посты', new PostResource),
            MenuItem::make('Услуги', new ServiceResource),
            MenuItem::make('Новые заказы', new OrderResource),
            MenuItem::make('В обработке', new OrdersInProcessResource),
            MenuItem::make('Завершённые', new CompletedOrdersResource),
            MenuItem::make('Отклонённые', new RejectedOrdersResource),
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource
                ),
            ]),

            MenuItem::make('Documentation', 'https://moonshine-laravel.com/docs')
                ->badge(fn () => 'Check')
                ->blank(),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
