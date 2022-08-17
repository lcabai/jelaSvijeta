<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
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

        App::setLocale($params['lang']);

        $query = Meal::select();

        if (isset($params['category'])) {
            if ($params['category'] == 'NULL') {
                $query = $query
                    ->whereNull('meals.category_id');
            } elseif ($params['category'] == '!NULL') {
                $query = $query
                    ->whereNotNull('meals.category_id');
            } else {
                $query = $query
                    ->where('meals.category_id', $params['category']);
            }
        }

        if (isset($params['tags'])) {
            $tags = explode(',', $params['tags']);

            foreach ($tags as $tag) {
                $meal_ids = DB::table('meal_tag')->where('tag_id', $tag)->pluck('meal_id');
                $query = $query
                    ->whereIn('meals.id', $meal_ids);
            }
        }

        if (isset($params['diff_time'])) {
            $date = date('Y-m-d H:i:s', $params['diff_time']);
            $query = $query
                ->where('meals.created_at', '>', $date);
        }

        if (isset($params['with'])) {

            $params = explode(',', $params['with']);

            foreach ($params as $p) {
                $query = $query
                    ->with($p);
            }
        }

        $per_page = isset($params['per_page']) ? $params['per_page'] : 10;
        $response = $query->paginate($per_page);
        return response()->json($response);
    }
}
