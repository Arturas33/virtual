<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use App\Models\VrResources;
use Illuminate\Routing\Controller;

class VrPagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrpages
	 *
	 * @return Response
	 */

	public function index()
	{
       //
	}

	public function indexFrontEnd($slug)
    {
        //
    }

    public function indexFrontEndEn($slug)
    {
        //
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /vrpages/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrpages
	 *
	 * @return Response
	 */
	public function store()
	{
      //
    }

	/**
	 * Display the specified resource.
	 * GET /vrpages/{id}
	 *
	 * @param  int  $id
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
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
       //
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	   //
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //
	}

    private function listBladeData()
    {
       //
    }
}