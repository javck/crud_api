
@model IEnumerable<foodfun.Models.Products>
    @using foodfun.Models;

    @{

        ViewBag.Title = "產品列表";
        Layout = "~/Views/Shared/_Layout.cshtml";
        string cate_no = ViewBag.CategoryNo;
        string cate_name = ViewBag.CategoryName;
        List<Categorys> categorys = new List<Categorys>();
        categorys = Shop.GetCategarysIsSale();
    }


    <section class="popular-items latest-padding">
        <div class="container">


            @*=========分類列表=========*@

            <div class="row product-btn justify-content-between mb-40">
                <div class="properties__button col-12">
                    <!--Nav Button  -->
                        <div class="scrollmenu ">
                            <div class="itemwidth ">
                                <a class="nav-item nav-link bg-danger mx-2 px-4 py-3" id="nav-home-tab" data-toggle="" href="/Product/CategoryList/HOT" role="tab" aria-controls="nav-home" aria-selected="true">熱門商品</a>
                                @foreach (var item in categorys)
                                {
                                    <a class="nav-item nav-link bg-danger mx-2 px-4 py-3" href="/Product/CategoryList/@item.category_no">@item.category_name</a>
                                }
                            </div>
                        </div>

                    <!--End Nav Button  -->
                </div>
            </div>


            @*=========商品==========*@
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        @foreach (var item in Model)
                        {
                            string img_path = Shop.GetProductImage(item.product_no, item.category_no);

                            <!-- card one -->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="@img_path" alt="">
                                        <div class="img-cap" data-toggle="modal" data-target="#@item.product_no">
                                            <span>
                                                @*@Html.ActionLink("Add to cart", "ProductDetail", "Products", new { id = item.product_no }, new { @class = "text-light" })*@
                                                <a class="text-light">加入餐點</a>
                                            </span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">


                                        <h3>
                                            <a data-toggle="modal" data-target="#@item.product_no">@Html.DisplayFor(modelItem => item.product_name)</a>
                                        </h3>
                                        <span>@Html.DisplayFor(modelItem => item.price_sale)</span>



                                    </div>
                                </div>
                            </div>
                            //=========================modal======================
                            using (Html.BeginForm())
                            {
                                Html.AntiForgeryToken();

                                <div class="modal fade" id="@item.product_no" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content product_image_area">

                                            <input type="hidden" id="product_no" name="product_no" value="@item.product_no">
                                            <input type="hidden" id="category_no" name="category_no" value="">
                                            <div>
                                                <img src="@img_path" alt="" class="card-img-top p-2">

                                            </div>
                                            <div class="modal-header text-center">
                                                <h3 class="modal-title text-center " id="exampleModalLongTitle">@item.product_name</h3>
                                            </div>
                                            <div class="modal-body">

                                                <div class="product_image_area">
                                                    <div class="container">
                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">
                                                                <div class="single_product_text text-center">
                                                                    <p>
                                                                        @item.description
                                                                    </p>
                                                                    <div class="pruduct_property">


                                                                        @{List<SelectListItem> lists = Shop.GetPropertyList(item.product_no);}

                                                                        @if (lists != null)
                                                                        {

                                                                            foreach (var item1 in lists)
                                                                            {

                                                                                <div class="section">
                                                                                    <span class="col-form-label">@item1.Text   </span>

                                                                                    <div class="form-check form-check-inline">
                                                                                        @{
                                                                                            List<string> prop_values = Shop.GetProductPropertyValue(item1.Value).Split('/').ToList();
                                                                                            foreach (var value in prop_values)
                                                                                            {
                                                                                                @Html.RadioButton(@item1.Value, @value, new { @class = "form-check-input" })
                                                                                                @Html.Label(item1.Value, @value, new { @class = "form-check-label" })

                                                                                            }
                                                                                        }
                                                                                    </div>
                                                                                </div>
                                                                            }
                                                                        }
                                                                    </div>
                                                                    <div class="card_area">
                                                                        <div class="product_count_area">
                                                                            <p>數量</p>
                                                                            <div class="product_count d-inline-block">
                                                                                <span class="product_count_item number-decrement"> <i class="ti-minus"></i></span>
                                                                                <input id=qty name="qty" class="product_count_item input-number" type="text" value="1" min="0" max="10">
                                                                                <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                                                            </div>
                                                                            <p>@string.Format("{0:C}", @item.price_sale)</p>
                                                                        </div>
                                                                        <div class="add_to_cart">
                                                                            <input type="submit" value="加入購物車" class="btn_3" />
                                                                            @*<a href="#" class="btn_3">add to cart</a>*@
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            }

                            @*=========================modal end======================*@

                        }

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(".number-decrement").click(function () {
            var qty = $(this).parent().find("input");
            var num = qty.val() - 1;
            if (num < 1) { num = 1; }
            qty.val(num);
        })
        $(".number-increment").click(function () {
            var qty = $(this).parent().find("input");
            var num = parseInt(qty.val()) + 1;

            qty.val(num);
        })


    </script>

    <!-- Button trigger modal -->
