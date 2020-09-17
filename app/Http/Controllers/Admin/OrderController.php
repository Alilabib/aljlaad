<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Requests\Order\AcceptRequest;

use App\Repositories\Order\OrderRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Provider\ProviderRepository;
use App\Repositories\Product\ProductRepository;
use App\Models\Order;
class OrderController extends Controller
{

    private $model;
    private $page;
    private $url;
    private $data;
    private $route;
    private $user;
    private $product;
    private $message;
    private $provider;
    public function __construct(OrderRepository $order,UserRepository $user,ProductRepository $product,ProviderRepository $provider)
    {
        $this->model = $order;
        $this->page  = 'dashboard.cruds.orders.';
        $this->url   = '/orders';
        $this->route = 'orders.index';
        $this->data  = [];
        $this->product = $product;
        $this->user = $user;
        $this->message  = 'تم بنجاح';
        $this->provider  = $provider;
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
        $providers = $this->provider->getAll();

        return view($this->page.'index',compact('data','providers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->user->getAll();
        $providers = $this->provider->getAll();
        $products = $this->product->getAll();
        return view($this->page.'create',compact('users','products','providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
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
        $users = $this->user->getAll();
        $products = $this->product->getAll();
        $providers = $this->provider->getAll();

        return view($this->page.'edit',compact('data','users','products','providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
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

    public function status(Request $request)
    {
        $data = Order::where('payment_type',$request->type)->get();
        $dataCount = count($data);
        $view = view($this->page.'ajax.orders', compact('data','dataCount'))->render();
        return response()->json(['value' => 1, 'view' => $view]);

    }

    public function accept(AcceptRequest $request)
    {
        $id = $request->order_id;
        $data['driver_id'] = $request->driver_id;
        $this->model->updateAttr($id,$data);
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>$this->message]);
    }
}
