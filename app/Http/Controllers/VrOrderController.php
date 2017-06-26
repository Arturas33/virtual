<?php namespace App\Http\Controllers;

use App\Models\VrOrder;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use App\Models\VrReservations;
use App\Models\VrUsers;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class VrOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrorder
     *
     * @return Response
     */
    public function index()
    {

        $config['list'] = VrOrder::get()->toArray();
        $config['title'] = trans('app.adminOrder');
        $config['route'] = route('app.orders.create');
        $config['create'] = 'app.orders.create';

        $config['show'] = 'app.orders.show';
        $config['edit'] = 'app.orders.edit';
        $config['delete'] = 'app.orders.destroy';


        // dd($config);
        return view('admin.list', $config);

    }


    /**
     * Show the form for creating a new resource.
     * GET /vrorder/create
     *
     * @return Response
     */
    public function create()
    {

        $config = $this->getFormData();
        $config['route'] = route('app.orders.create');
        $config['back'] = 'app.orders.index';
//        dd($config);


        return view('admin.form', $config);

    }

    /**
     * Store a newly created resource in storage.
     * POST /vrorder
     *
     * @return Response
     */
    public function store()
    {
        $data = request()->all();
        VrOrder::create($data);


        // dd($record);

        return redirect(route('app.orders.index'));

    }

    /**
     * Display the specified resource.
     * GET /vrorder/{id}
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
     * GET /vrorder/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $record = VrOrder::find($id)->toArray();
        $config = $this->getFormData();
        $config['record'] = $record;
        $config['titleForm'] = $id;
        $config['route'] = route('app.orders.edit', $id);
        $config['back'] = 'app.orders.index';

        return view('admin.form', $config);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrorder/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $data = request()->all();
        $record = VrOrder::find($id);
        $record->update($data);


        return redirect(route('app.orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrorder/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    private function getVRroomsWithcategory()
    {
        $pagesData = (new VrPages)->getTable();
        $pagesDataTrans = (new VrPagesTranslations)->getTable();

        return (VrPages::where('category_id', 'vr_rooms')->join($pagesDataTrans, "$pagesDataTrans.record_id", '=', "$pagesData.id")
            ->pluck("$pagesDataTrans.title", "$pagesData.id")->toArray());

    }

    private function getFormData()
    {

        $options = [];
        $now = Carbon::now();
        $end_data = Carbon::createFromDate()->addDay(14);
        for ($option = $now; $option->lte($end_data); $option->addDay()) {
            $options[$option->format('Y-m-d')] = $option->format('Y-m-d');
        }


        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "time",
            "options" => $options
        ];

        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "virtual_room",
            "options" => $this->getVRroomsWithcategory()
        ];

        $config['fields'][] = [
            'type' => 'drop_down',
            'key' => 'user_id',
            'options' => VrUsers::pluck('email', 'id')->toArray(),
        ];
        
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "status",
            'options' => [
                'pending' => trans('app.pending'),
                'canceled' => trans('app.canceled'),
                'aproved' => trans('app.aproved'),
            ],

        ];

        return $config;
    }
}