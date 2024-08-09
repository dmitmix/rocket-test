<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Получение списка товаров с фильтрацией и пагинацией.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
         // Начальная выборка всех продуктов с их свойствами
        $query = Product::with(['properties']);

        // Фильтрация по свойствам
        if ($request->has('properties')) {
            foreach ($request->get('properties') as $propertyName => $values) {
                if (!is_array($values)) {
                $values = [$values]; // Преобразуем значение в массив, если это строка
            }
                $query->whereHas('properties', function ($q) use ($propertyName, $values) {
                    $q->where('name', $propertyName)->whereIn('value', $values);
                });
            }
        }

        // Пагинация по 40 элементов на страницу
        $products = $query->paginate(40);

        // Возвращаем JSON с результатами
        return response()->json($products);
    }
}
