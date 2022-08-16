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

        // $tag = $request->input('tag');
        // echo gettype($tag);  Type is 'string'
        // die;

        $validator = Validator::make($request->all(), [
            'per_page'    => 'sometimes|integer',
            'page'        => 'sometimes|integer',
            'category'    => 'nullable|string',
            'tags'        => 'sometimes|string',
            'with'        => 'sometimes|string',
            'lang'        => 'required|string|min:2',
            'diff_time'   => 'sometimes|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $query = Meal::select();

        if (isset($params['lang'])) {

            app()->setLocale($params['lang']);
        } else {
            app()->setLocale('hr');
        }

        if (isset($params['with'])) {

            $withParams = explode(',', $params['with']);
            $filter = array('tag', 'ingredient', 'category');

            foreach ($withParams as $param) {

                if (in_array($param, $filter, true)) {
                    $query->with($param);
                }
            }
        }

        if (isset($params['category'])) {

            if (is_numeric($params['category'])) {
                $query->where('category_id', $params['category']);
            } elseif ($params['category'] == 'NULL') {
                $query->whereNull('category_id');
            } elseif ($params['category'] == '!NULL') {
                $query->whereNotNull('category_id');
            }
        }

        if (isset($params['diff_time'])) {

            $query_diff_time = Meal::select()->first();
            $data = Carbon::createFromTimestamp($params['diff_time'])->toDateTimeString();

            $query_diff_time->whereDate('created_at', '>=', $data)->whereDate('updated_at', '>', $data)->update(['status' => 'created']);
            $query_diff_time->whereDate('updated_at', '<=', $data)->update(['status' => 'modified']);
            // $query_diff_time->whereDate('deleted_at', '<=', $data)->update(['status' => 'deleted']);
        }

        if (isset($params['tag'])) {
            $tag = explode(',', $params['tag']);
            $query->join('meal_tag', 'meals.id', '=', 'meal_tag.meal_id');
            $query->whereIn('meal_tag.tag_id', $tag);
        }

        $per_page = isset($params['per_page']) ? $params['per_page'] : 10;
        $meals = $query->paginate($per_page);

        // Get the results and return them.
        return $meals;
    }


    public function show($id)
    {
        return Meal::findOrFail($id);
    }

    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();
        return '';
    }
}
