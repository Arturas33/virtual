<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use App\Models\VrResources;
use Illuminate\Routing\Controller;

class VrPagesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrpages
     *
     * @return Response
     */

    public function index()
    {
        $config['list'] = VrPages::get()->toArray();
        $config['title'] = trans('app.adminPages');
        $config['route'] = route('app.pages.create');
        $config['create'] = 'app.pages.create';

        $config['show'] = 'app.pages.show';
        $config['edit'] = 'app.pages.edit';
        $config['delete'] = 'app.pages.destroy';

        //dd($config);

        return view('admin.list', $config);

    }

    /**
     * Show the form for creating a new resource.
     * GET /vrpages/create
     *
     * @return Response
     */
    public function create()
    {
        $config = $this->getFormData();
        //dd($config);
        $config['route'] = route('app.pages.create');
        $config['back'] = 'app.pages.index';

        //dd($config);

        return view('admin.form', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrpages
     *
     * @return Response
     */
    public function store()
    {
        $data = request()->all();
        //dd($data);
        $resources = request()->file('file');
      //  dd($resources);

        $uploadController = new VrResourcesController();

        $record = $uploadController->upload($resources);
        $data['cover_id'] = $record->id;



        $record = VrPages::create($data);
        $data['record_id'] = $record->id;
        VrPagesTranslations::create($data);


        return redirect(route('app.pages.edit', $record->id));
    }

    /**
     * Display the specified resource.
     * GET /vrpages/{id}
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
     * GET /vrpages/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $record = VrPages::find($id)->toArray();

        $record['slug'] = $record['translations']['slug'];
        $record['title'] = $record['translations']['title'];
        $record['language_code'] = $record['translations']['language_code'];
        $record['description_short'] = $record['translations']['description_short'];
        $record['description_long'] = $record['translations']['description_long'];
        $record['upload'] = $record['upload']['path'];
       // dd($record);


        $config = $this->getFormData();
        $config['record'] = $record;
        $config['titleForm'] = $id;
        $config['route'] = route('app.pages.edit', $id);
        $config['back'] = 'app.pages.index';
      // dd($config);
        return view('admin.form', $config);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrpages/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $data = request()->all();
        $record = VrPages::find($id);
      // dd($record);
        $record->update($data);
        $data['record_id'] = $id;
        VrPagesTranslations::updateOrCreate([
            'record_id' => $id,
            'language_code' => $data['language_code']
        ],$data);

        return redirect(route('app.pages.index', $record->id));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrpages/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        VrPagesTranslations::destroy(VrPagesTranslations::where('record_id', $id)->pluck('id')->toArray());
        VrPages::destroy($id);
        return ["success" => true, "id" => $id];
    }

    private function getFormData()
    {

        $language = request('language_code');
        if ($language == null)
            $language = app()->getLocale();


        $config['fields'][] = [
            'type' => 'drop_down',
            'key' => 'language_code',
            'options' => getActiveLanguages()
        ];
        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'title',
        ];
        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'description_short'
        ];

        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'description_long'
        ];

        $config['fields'][] = [
            'type' => 'single_line',
            'key' => 'slug'
        ];
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "category_id",
            "label" => trans('app.adminCategory'),
            "options" => VrCategoriesTranslations::where('language_code', $language)->pluck('name', 'record_id'),
        ];
        $config['fields'][] = [
            "type" => "upload_form",
            "key" => "upload",

        ];
        return $config;
    }


}