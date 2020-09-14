<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Slider\SliderRequest;
use App\Repositories\Slider\SliderRepository;
use App\Repositories\SubCategory\SubCategoryRepository;

class SliderController extends Controller
{

    private $model;
    private $page;
    private $url;
    private $route;
    private $data;
    private $category;
    private $message;

    public function __construct(SliderRepository $Slider,SubCategoryRepository $category)
    {
        $this->model = $Slider;
        $this->page  = 'dashboard.cruds.sliders.';
        $this->url   = '/sliders';
        $this->route = 'sliders.index';
        $this->data  = [];
        $this->category = $category;
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
        $categories = $this->category->getAll();
        return view($this->page.'create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
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
        $categories = $this->category->getAll();
        return view($this->page.'edit',compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
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
}
