@extends('layouts.site')

@section('body')
<!-- Hero Area Start-->
            <div class="slider-area">
                <div class="single-slider slider-height2 d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap text-center">
                                    <h2>完成付款</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================Checkout Area =================-->
            <section class="checkout_area section_padding">
                <div class="container">
                    <div class="billing_details">
                        <div class="row">
                            <form class="row contact_form" action="{{ url('checkout') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="col-lg-8">
                                <h3>訂單明細</h3>
                                    <div class="col-md-6 form-group p_star">
                                        <input type="text" class="form-control" id="receive_name" name="receive_name" />
                                        <span class="placeholder" data-placeholder="姓名"></span>
                                    </div>
                                    <div class="col-md-6 form-group p_star">
                                        <input type="text" class="form-control" id="receive_phone" name="receive_phone" />
                                        <span class="placeholder" data-placeholder="電話"></span>
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="textarea" class="form-control" id="receive_address" name="receive_address" />
                                        <span class="placeholder" data-placeholder="請輸入地址"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="creat_account">
                                            <h3>訂單類型</h3>
                                            <input type="hidden" id="type" name="type" value="online"/>
                                            <label for="f-option3">線上訂單</label>
                                        </div>
                                        <textarea class="form-control" name="remark" id="remark" rows="1" placeholder="備註"></textarea>
                                    </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="order_box">
                                    <h2>你的訂單</h2>
                                    <ul class="list">
                                        <li>
                                            <a href="#"
                                                >產品
                                                <span>總計</span>
                                            </a>
                                        </li>
                                        @foreach ($cart_items as $item)
                                        <li>
                                            <a href="#"
                                                >{{ $item->name }}
                                                <span class="middle">x {{ $item->quantity }}</span>
                                                <span class="last">${{ $item->price * $item->quantity }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <ul class="list list_2">
                                        <li>
                                            <a href="#"
                                                >小計
                                                <span>${{ $subtotal }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                >運費
                                                <span>貨運: ${{ $transport_fee }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                >總計
                                                <span>${{ $total }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="payment_item active">
                                        <div class="radion_btn">
                                            <input type="radio" id="pay_type" name="pay_type" value="credit" checked>
                                            <label for="f-option6">信用卡 </label>
                                            <img src="img/product/single-product/card.jpg" alt="" />
                                            <div class="check"></div>
                                        </div>
                                        <p>使用第三方金流來進行刷卡交易</p>
                                    </div>
                                    <div class="creat_account">
                                        <input type="checkbox" id="f-option4" name="selector" />
                                        <label for="f-option4">我同意這些合約要求 </label>
                                        <a href="#">交易合約內容*</a>
                                    </div>
                                    <input class="btn_3" type="submit" value="前往付款">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================End Checkout Area =================-->

@stop
