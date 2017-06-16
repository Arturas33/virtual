<?php

namespace App\Http\Controllers;

use App\Models\VrMenuTranslations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VrMenu;
use Illuminate\Support\Facades\DB;
use Session;


class VrMenuController extends Controller
{

    public function frontendIndex()
    {
        //
    }


    /**
     * Display a listing of the resource.
     * GET /vrmenu
     *
     * @return Response
     */
    public function index()
    {

        $config['list'] = VrMenu::get()->toArray();
        $config['title'] = trans('app.adminMenu');
        $config['route'] = route('app.menu.create');
        $config['create'] = 'app.menu.create';

        $config['edit'] = 'app.menu.edit';
        $config['delete'] = 'app.menu.destroy';


        return view('admin.list', $config);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function create()
    {
        $config = $this->getFormData();
        $config['route'] = route('app.menu.create');
        $config['back'] = 'app.menu.index';

        return view('admin.form', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */


    public function store()
    {

        $data = request()->all();
        $record = VrMenu::create($data);
        $data['record_id'] = $record->id;
        VrMenuTranslations::create($data);

        // dd($record);

        return redirect(route('app.menu.edit', $record->id));


    }

    /**
     * Display the specified resource.
     * GET /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrmenu/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
         $record = VrMenu::find($id)->toArray();
        $record['url'] = $record['translations']['url'];
        $record['name'] = $record['translations']['name'];
        $record['language_code'] = $record ['translations']['language_code'];



        $config = $this->getFormData();
        $config['record'] = $record;
        $config['titleForm']= $id;
        $config['route'] = route('app.menu.create', $id);
        $config['back'] = 'app.menu.index';



        return view('admin.form', $config);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        //
    }

    private function getFormData()
    {

        $language = request('language_code');
        if($language == null)
            $language = app()->getLocale();

        $config['fields'][] = [
            'type' => 'drop_down',
            'key' => 'language_code',
            'options' => getActiveLanguages()
        ];
        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'name',
        ];
        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'url'
        ];

        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'sequence'
        ];

        $config['fields'][] = [
            'type' => 'check_box',
            'key' => 'new_window',
            'options' => [
                [
                    'name' => 'new_window',
                    'value' => 1,
                    'title' => trans('app.new_window'),
                ],

            ]

        ];
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "parent_id",
            "label" => trans('app.adminParent'),
            "options" => VrMenuTranslations::where('language_code', $language)->pluck('name', 'record_id'),
          ];
        return $config;
    }
}