<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'image' => 'img/spec.png',
                'title' => 'Разработка со специалистом',
                'text' => 'Создадим мерч вместе с вами — от идеи до готового изделия',
                'price' => 'от 4500 ₽',
                'service_type' => 'Разработка со специалистом',
                'sort_order' => 1,
            ],
            [
                'image' => 'img/print.png',
                'title' => 'Нанесение принта',
                'text' => 'Цифровая печать на ткани любой сложности и формата',
                'price' => 'от 4300 ₽',
                'service_type' => 'Нанесение принта',
                'sort_order' => 2,
            ],
            [
                'image' => 'img/opt.png',
                'title' => 'Оптовые заказы',
                'text' => 'Индивидуальные условия для бизнеса, команд и мероприятий',
                'price' => 'договорная',
                'service_type' => 'Оптовый заказ',
                'sort_order' => 3,
            ],
            [
                'image' => 'img/pen.png',
                'title' => 'Подпись одежды',
                'text' => 'Автограф, имя или надпись — аккуратно и долговечно',
                'price' => '300 ₽',
                'service_type' => 'Подпись одежды',
                'sort_order' => 4,
            ],
            [
                'image' => 'img/design.png',
                'title' => 'Разработка дизайна',
                'text' => 'Подготовим макет или векторную версию вашего принта',
                'price' => 'от 300 ₽',
                'service_type' => 'Разработка дизайна',
                'sort_order' => 5,
            ],
            [
                'image' => 'img/par.png',
                'title' => 'Парные вышивки',
                'text' => 'Комплекты для пар, семей, друзей и спортивных команд',
                'price' => 'от 7000 ₽',
                'service_type' => 'Парные вышивки',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $data) {
            Service::query()->firstOrCreate(
                ['service_type' => $data['service_type']],
                $data
            );
        }
    }
}
