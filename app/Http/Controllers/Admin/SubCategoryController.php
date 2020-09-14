<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Subcategory\SubcategoryRequest;
use App\Repositories\SubCategory\SubCategoryRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\City\CityRepository;

class SubCategoryController extends Controller
{
    private $model;
    private $city;
    private $page;
    private $url;
    private $data;
    private $route;
    private $category;
    private $message;

    public function __construct(SubCategoryRepository $subcategory,CategoryRepository $category, CityRepository $city)
    {
        $this->model = $subcategory;
        $this->page  = 'dashboard.cruds.subcategories.';
        $this->url   = '/subcategories';
        $this->route = 'subcategories.index';
        $this->data  = [];
        $this->category = $category;
        $this->city = $city;
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
        $cities = $this->city->getAll();
        return view($this->page.'create',compact('categories','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
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
        $cities = $this->city->getAll();

        return view($this->page.'edit',compact('data','categories','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
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
