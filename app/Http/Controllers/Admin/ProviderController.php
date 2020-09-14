<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;
use App\Repositories\Provider\ProviderRepository;
use App\Repositories\Area\AreaRepository;
use App\Repositories\City\CityRepository;

class ProviderController extends Controller
{
    private $model;
    private $city;
    private $area;
    private $page;
    private $url;
    private $route;
    private $data;
    private $message;

    public function __construct(ProviderRepository $provider,CityRepository $city,AreaRepository $area)
    {
        $this->model = $provider;
        $this->city = $city;
        $this->area = $area;
        $this->page  = 'dashboard.cruds.providers.';
        $this->url   = '/providers';
        $this->route = 'providers.index';
        $this->data  = [];
        $this->message  = 'تم بنجاح';

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->model->getAll();
        return view($this->page.'index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->city->getAll();

        return view($this->page.'create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>$this->message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $data = $this->model->getByID($id);
        $cities = $this->city->getAll();
        $areas  = $this->area->getByCityId($data->city_id);

        return view($this->page.'edit',compact('data','cities','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->model->update($id,$request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>$this->message]);
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
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>$this->message]);
    }

    public function getAreas(Request $request)
    {
        $areas = $this->area->getByCityId($request->id);
        $view = view($this->page.'ajax.areas', compact('areas'))->render();
        return response()->json(['value' => 1, 'view' => $view]);
    }
}
