<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * Unauthorized users can go to / page
     *
     * PageController constructor.
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function mainPage()
    {
        return view('welcome');
    }

    /**
     * Fetch children
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */

    public function fetchChildren ($id)
    {

        $collection = Employee::find($id)->children()->get();

        $subordinates = $collection->map(function ($item, $key) {
            return ['id' => $item->id,
                    'parent' => $item->parent_id,
                    'name' => $item->name,
                    'position' => $item->position,
                    'date_of_employment' => $item->date_of_employment,
                    'salary' => $item->salary,
                    'text' => null,
//                    'text' => '<span>' . $item->name . '   '. $item->position . '   ' . $item->date_of_employment . '   ' . $item->salary . '</span>',
                    'childrenNumber' => $childrenNumber = Employee::find($item->id)->children()->count(),
                    'hierarchyLevel' => $item-> hierarchy_level,
                    'icon' => 'glyphicon glyphicon-user',
                    'state' => [
                        'opened' => false,
                        'disabled' => false,
                        'selected' => false,
                    ],
                    'li_attr' => [],
                    'a_attr' => [],
                    'children' => $childrenNumber === 0 ? false : true,
            ];

        });

        return response($subordinates, 200);

    }

    /**Fetch roots
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */

    public function fetchRoots()
    {

        $collection = Employee::where ('hierarchy_level', '=', 1)->get();

        $firstLevelEmployees = $collection->map(function ($item, $key) {
            return ['id' => $item->id,
                    'parent' => '#',
                    'name' => $item->name,
                    'position' => $item->position,
                    'date_of_employment' => $item->date_of_employment,
                    'salary' => $item->salary,
                    'text' => null,
//                    'text' => '<span>' . $item->name . '   '. $item->position . '   ' . $item->date_of_employment . '   ' . $item->salary . '</span>',
                    'childrenNumber' => $childrenNumber = Employee::find($item->id)->children()->count(),
                    'hierarchyLevel' => $item-> hierarchy_level,
                    'icon' => 'glyphicon glyphicon-user',
                    'state' => [
                        'opened' => false,
                        'disabled' => false,
                        'selected' => false,
                    ],
                    'li_attr' => [],
                    'a_attr' => [],
                    'children' => $childrenNumber === 0 ? false : true,
            ];

        });

        return response($firstLevelEmployees, 200);
    }

}
