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

        $query = DB::table('meal_translations')
            ->where('language_id', $language_id)
            ->leftJoin('meals', 'meal_id', 'meals.id')
            ->get();

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

        if (isset($params['tag'])) {
            $tags = explode(',', $params['tag']);
            $tags_table = DB::table('tag_translations')
                ->where('language_id', $language_id)
                ->leftJoin('tags', 'tag_id', 'tags.id')
                ->leftJoin('meal_tag', 'tag_id', 'meal_tag.tag_id')
                ->get();

            $query = $query
                ->leftJoin($tags_table, 'id', 'meal_id')
                ->whereIn('tag_id', $tags);
        }

        if (isset($params['diff_time'])) {
        }


        if (isset($params['with'])) {
        }

        // ->select('meal_id as id', 'title', 'description', 'status')

        // $per_page = isset($params['per_page']) ? $params['per_page'] : 10;
        return $query;
        // ->paginate($per_page);
    }
}
