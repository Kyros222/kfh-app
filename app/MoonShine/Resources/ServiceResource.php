<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Fields\Number;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Service>
 */
class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $title = 'Услуги';

    protected string $sortColumn = 'sort_order';

    protected string $sortDirection = 'asc';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),

                Text::make('Название', 'title')
                    ->required()
                    ->sortable(),

                Textarea::make('Описание', 'text')
                    ->required()
                    ->hideOnIndex(),

                Text::make('Цена', 'price')
                    ->required()
                    ->hint('Например: от 300 ₽  или  договорная'),

                Text::make('Тип услуги (для формы заказа)', 'service_type')
                    ->required()
                    ->hideOnIndex(),

                Number::make('Порядок', 'sort_order')
                    ->sortable()
                    ->default(0),

                Switcher::make('Показывать', 'is_active')
                    ->sortable(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'string', 'max:100'],
            'service_type' => ['required', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}
