<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Fields\Url;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Посты';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')->required(),


                Image::make('Картинка (файл)', 'image')
                    ->setName('image_file')
                    ->disk('public')
                    ->dir('posts')
                    ->changeFill(fn($data) => str_starts_with((string) $data->image, 'http') ? null : $data->image)
                    ->onApply(function (Model $item, $value) {
                        if (request()->hasFile('image_file')) {
                            $item->image = request()->file('image_file')->store('posts', 'public');
                        }
                        return $item;
                    })
                    ->nullable(),


                Url::make('Картинка (ссылка)', 'image')
                    ->setName('image_url')
                    ->changeFill(fn($data) => str_starts_with((string) $data->image, 'http') ? $data->image : null)
                    // Сохраняем URL только если файл не был загружен
                    ->onApply(function (Model $item, $value) {
                        if (request()->hasFile('image_file')) {
                            $item->image = request()->file('image_file')->store('posts', 'public');
                        }
                        return $item;
                    })
                    ->nullable(),

                Textarea::make('Текст', 'text')->required(),
            ]),
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'image_file' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,gif,webp,bmp,svg,avif,tif,tiff,ico,heic,heif',
                'max:5120',
                'required_without:image_url',
            ],
            'image_url' => [
                'nullable',
                'url',
                'max:2048',
                'required_without:image_file',
            ],
            'text' => ['required', 'string', 'max:5000'],
        ];
    }
}
