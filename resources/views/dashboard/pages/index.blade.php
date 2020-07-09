@extends('dashboard.layout.layout')
@section('content')
                    <!-- Quick Overview -->
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="be_pages_ecom_orders.html">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">35</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        Pending Orders
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-success">33%</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        Profit
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-dark">109</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        Orders Today
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-dark">$8920</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        Earnings Today
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- END Quick Overview -->

                    <!-- Orders Overview -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Orders Overview</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- Chart.js is initialized in js/pages/be_pages_ecom_dashboard.min.js which was auto compiled from _es6/pages/be_pages_ecom_dashboard.js) -->
                            <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                            <div style="height: 400px;"><canvas class="js-chartjs-overview"></canvas></div>
                        </div>
                    </div>
                    <!-- END Orders Overview -->

                    <!-- Top Products and Latest Orders -->
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Top Products -->
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Top Products</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                                        <tbody>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.965</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Diablo III</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.154</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Control</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.523</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Minecraft</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.423</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Hollow Knight</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.391</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Sekiro: Shadows Die Twice</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.218</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">NBA 2K20</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.995</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Forza Motorsport 7</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.761</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Minecraft</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.860</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Dark Souls III</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.952</a>
                                                </td>
                                                <td>
                                                    <a href="be_pages_ecom_product_edit.html">Age of Mythology</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END Top Products -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Latest Orders -->
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Latest Orders</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                                        <tbody>
                                            <tr>
                                                <td class="font-w600 text-center" style="width: 100px;">
                                                    <a href="be_pages_ecom_order.html">ORD.7116</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Susan Day</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Delivered</span>
                                                </td>
                                                <td class="font-w600 text-right">$657,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7115</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Justin Hunt</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger">Canceled</span>
                                                </td>
                                                <td class="font-w600 text-right">$158,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7114</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Megan Fuller</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Delivered</span>
                                                </td>
                                                <td class="font-w600 text-right">$952,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7113</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Amanda Powell</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Processing</span>
                                                </td>
                                                <td class="font-w600 text-right">$898,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7112</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Betty Kelley</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Delivered</span>
                                                </td>
                                                <td class="font-w600 text-right">$782,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7111</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Thomas Riley</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Processing</span>
                                                </td>
                                                <td class="font-w600 text-right">$529,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7110</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Jesse Fisher</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Delivered</span>
                                                </td>
                                                <td class="font-w600 text-right">$892,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7109</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Albert Ray</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Processing</span>
                                                </td>
                                                <td class="font-w600 text-right">$226,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7108</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Lori Moore</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Delivered</span>
                                                </td>
                                                <td class="font-w600 text-right">$677,00</td>
                                            </tr>
                                            <tr>
                                                <td class="font-w600 text-center">
                                                    <a href="be_pages_ecom_order.html">ORD.7107</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html">Lori Grant</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger">Canceled</span>
                                                </td>
                                                <td class="font-w600 text-right">$691,00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END Latest Orders -->
                        </div>
                    </div>
                    <!-- END Top Products and Latest Orders -->
@endsection