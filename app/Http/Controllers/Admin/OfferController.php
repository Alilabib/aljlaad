<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Offer\OfferRequest;
use App\Repositories\Offer\OfferRepository;
class OfferController extends Controller
{

    private $model;
    private $page;
    private $url;
    private $data;
    private $route;
    public function __construct(OfferRepository $offer)
    {
        $this->model = $offer;
        $this->page  = 'dashboard.cruds.offers.';
        $this->url   = '/offers';
        $this->data  = [];
        $this->route = 'offers.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['data'] = $this->model->getAll();
        return view($this->page.'index',$this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view($this->page.'create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        //
        $this->model->create($request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data added messages']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = $this->model->getByID($id);
        return view($this->page.'show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = $this->model->getByID($id);
        return view($this->page.'edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, $id)
    {
        $this->model->update($id,$request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data added messages']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data Deleted successfully']);
    }
}