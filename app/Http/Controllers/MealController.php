<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();

        $validator = Validator::make($params, [
            'per_page'    => ['nullable', 'integer', 'min:1'],
            'page'        => ['nullable', 'integer', 'min:1'],
            'category'    => ['nullable', 'string'],
            'tags'        => ['nullable', 'string'],
            'with'        => ['nullable', 'string'],
            'diff_time'   => ['nullable', 'integer'],
            'lang'        => ['required', 'string', 'min:2', function ($attribute, $value, $fail) {
                if (!in_array($value, ['hr', 'en', 'fr'])) {
                    $fail('The ' . $attribute . ' must be hr, en or fr.');
                }
            },]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $language_id = match ($params['lang']) {
            'hr' => 1,
            'en' => 2,
            'fr' => 3,
        };

        $query = Meal::select();

        if (isset($params['category'])) {
            if ($params['category'] == 'NULL') {
                $query = $query
                    ->whereNull('category_id');
            } elseif ($params['category'] == '!NULL') {
                $query = $query
                    ->whereNotNull('category_id');
            } else {
                $query = $query
                    ->where('category_id', $params['category']);
            }
        }

        if (isset($params['tags'])) {
            $tags = explode(',', $params['tags']);

            foreach ($tags as $tag) {
                $meal_ids = DB::table('meal_tag')->where('tag_id', $tag)->pluck('meal_id');
                $query = $query
                    ->whereIn('id', $meal_ids);
            }
        }

        if (isset($params['diff_time'])) {
            $date = date('Y-m-d H:i:s', $params['diff_time']);
            $query = $query
                ->where('created_at', '>', $date);
        }


        if (isset($params['with'])) {
        }

        // $query = MealTranslation::select()
        //     ->where('language_id', $language_id)
        //     ->leftJoin('meals', 'meal_id', 'meals.id');
        $query = $query->get();
        // ->select('meal_id as id', 'title', 'description', 'status')

        // $per_page = isset($params['per_page']) ? $params['per_page'] : 10;
        return $query;
        // ->paginate($per_page);
    }
}
