<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealTranslation;
use Illuminate\Http\Request;

use Carbon\Carbon;


use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();

        $validator = Validator::make($request->all(), [
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

        $query = MealTranslation::select();


        if (isset($params['with'])) {
        }

        if (isset($params['category'])) {
        }

        if (isset($params['diff_time'])) {
        }

        if (isset($params['tag'])) {
        }

        $per_page = isset($params['per_page']) ? $params['per_page'] : 10;
        return $query->paginate($per_page);
    }
}
