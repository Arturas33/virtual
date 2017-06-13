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
        $config['tableName'] = trans('app.adminMenu');
        $config['list'] = VrMenu::get()->toArray();
        $config['route'] = route('app.menu.create');
        $config['create'] = 'app.menu.create';
        $config['edit'] = 'app.menu.edit';

        $config['delete'] = 'app.menu.destroy';

       
        return view('admin.menu', $config);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function create()
    {
//        $config = $this->getFormData();
//
//        return view('admin.menu', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */


    public function store(Request $request)
    {
        //

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
        //
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

    private function listBladeData()
    {
//
//        $config['fields'][]=[
//            'type'=>'drop_down',
//            'key'=>'language_code',
//            'options'=>getActiveLanguages()
//        ];
//        $config['fields'][]=[
//            'type'=>'single_line',
//            'key' => 'name',
//        ];
//         $config['fields'][]=[
//           'type'=>'single_line',
//             'key'=>'url'
//         ];
//        $config['fields'][]=[
//            'type'=>'check_box',
//            'key'=>'new_windows',
//            'options'
//        ];
//
//        return $config;
    }
}