<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Date;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Order>
 */
class CompletedOrdersResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Завершённые заказы';

    protected string $sortColumn = 'created_at';

    protected string $sortDirection = 'desc';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),

                Text::make('Имя', 'name')
                    ->sortable(),

                Text::make('Контакт', 'contact'),

                Textarea::make('Сообщение', 'message')
                    ->hideOnIndex(),

                Text::make('Тип услуги', 'service_type')
                    ->nullable(),

                Select::make('Статус', 'status')
                    ->options([
                        'Новый' => 'Новый',
                        'Принятый в обработку' => 'Принятый в обработку',
                        'Завершённый' => 'Завершённый',
                        'Отклонённый' => 'Отклонённый',
                    ])
                    ->sortable(),

                Date::make('Дата создания', 'created_at')
                    ->sortable()
                    ->hideOnForm(),
            ]),
        ];
    }

    /**
     * @param  Order  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'service_type' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string'],
        ];
    }
    public function query(): \Illuminate\Contracts\Database\Eloquent\Builder
    {
        return parent::query()->where('status', 'Завершённый');
    }
}
