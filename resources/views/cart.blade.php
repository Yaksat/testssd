@extends('layouts.app')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Cart</span></p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr class="text-center" data-id="{{$item->id}}">
                                    <div class="qty" data-id="{{$item->quantity}}">
                                        <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a>
                                        </td>

                                        <td class="image-prod">
                                            <div class="img"
                                                 style="background-image: url('{{ asset('storage/'.$item['attributes']['img']) }}');"></div>
                                        </td>

                                        <td class="product-name">
                                            <h3>{{$item['name']}}</h3>
                                            <p>{{$item['attributes']['content']}}</p>
                                        </td>

                                        <td class="price">${{$item['price']}}</td>

                                        <td>
                                            {{--                                            <div class="input-group mb-3">--}}
                                            {{--                                                <input type="text" name="quantity"--}}
                                            {{--                                                       class="quantity form-control input-number"--}}
                                            {{--                                                       value="1" min="1" max="100">--}}
                                            {{--                                            </div>--}}
                                            <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="ion-ios-remove"></i>
                                </button>
                            </span>
                                                <input type="text" id="quantity" name="quantity"
                                                       class="form-control input-number"
                                                       value="{{$item['quantity']}}" min="1" max="100">
                                                <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="ion-ios-add"></i>
                                </button>
                            </span>
                                            </div>
                                        </td>

                                        <td class="total">${{$item['price'] * $item['quantity']}}</td>
                                    </div>
                                </tr><!-- END TR-->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex subtotal-price">
                            <span>Subtotal</span>
                            <span>${{ $subtotal }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$0.00</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>$3.00</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>${{ $subtotal + 3.00}}</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="/checkout" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>

        $(document).ready(function () {
            $('.quantity-right-plus').click(function (e) {
                e.preventDefault();

                var $input = $(this).parent().siblings('.input-number');
                var currentValue = parseInt($input.val());

                $input.val(currentValue + 1);

                var $row = $(this).closest('tr.text-center');
                var price = parseFloat($row.find('td.price').text().replace('$', ''));
                var id = parseInt($row.data('id'));
                var new_price = (currentValue + 1) * price;
                new_price = new_price.toFixed(2);
                $row.find('td.total').text(new_price);

                var total_qty = parseInt($('.icon-shopping_cart').text());

                total_qty += 1
                $('.icon-shopping_cart').text(total_qty)

                var total = parseFloat($(".total-price span:last").text().replace('$', ''));
                total += price;
                total = total.toFixed(2);
                $(".total-price span:last").text(total);

                var sub_total = parseFloat($(".subtotal-price span:last").text().replace('$', ''));
                sub_total += price;
                sub_total = sub_total.toFixed(2);
                $(".subtotal-price span:last").text(sub_total);

                updateCart(id, currentValue + 1);

            });

            $('.quantity-left-minus').click(function (e) {
                e.preventDefault();

                var $input = $(this).parent().siblings('.input-number');
                var currentValue = parseInt($input.val());

                if (currentValue > 1) {
                    $input.val(currentValue - 1);

                    var $row = $(this).closest('tr.text-center');
                    var price = parseFloat($row.find('td.price').text().replace('$', ''));
                    var id = parseInt($row.data('id'));
                    var new_price = (currentValue - 1) * price;
                    new_price = new_price.toFixed(2);
                    $row.find('td.total').text(new_price);

                    var total_qty = parseInt($('.icon-shopping_cart').text());

                    total_qty -= 1
                    $('.icon-shopping_cart').text(total_qty)

                    var total = parseFloat($(".total-price span:last").text().replace('$', ''));
                    total -= price;
                    total = total.toFixed(2);
                    $(".total-price span:last").text(total);

                    var sub_total = parseFloat($(".subtotal-price span:last").text().replace('$', ''));
                    sub_total -= price;
                    sub_total = sub_total.toFixed(2);
                    $(".subtotal-price span:last").text(sub_total);

                    updateCart(id, currentValue - 1);
                }
            });

            $('.product-remove').click(function () {
                event.preventDefault()
                var id = $(this).closest('.text-center').data('id');
                // var quantity = $(this).closest('.qty').data('id');
                var quantity = $(this).closest('#quantity').val()
                removeFromCart(id, quantity)
            })
        });

        function updateCart(id, quantity) {
            $.ajax({
                url: "{{route('updateCart')}}",
                type: "POST",
                data: {
                    id: id,
                    quantity: quantity,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    console.log(data)
                }
            })
        }

        function addToCart(id) {
            var total_qty = parseInt($('.icon-shopping_cart').text());

            total_qty += 1
            $('.icon-shopping_cart').text(total_qty)

            $.ajax({
                url: "{{route('addToCart')}}",
                type: "POST",
                data: {
                    id: id,
                    quantity: 1,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    console.log(data)
                }
            })
        }

        function removeFromCart(id, quantity) {

            var total_qty = parseInt($('.icon-shopping_cart').text());

            total_qty -= quantity
            $('.icon-shopping_cart').text(total_qty)

            $.ajax({
                url: "{{route('removeFromCart')}}",
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    console.log(data)
                    location.reload();
                }
            })
        }
    </script>
@endsection
