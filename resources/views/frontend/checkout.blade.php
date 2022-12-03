@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/')}} ">
                    Home
                </a> /
                <a href="{{ url('checkout') }}">
                    Checkout
                </a>
            </h6>
        </div>
    </div>
    <div class="container mt-3">
        <form action="{{ url('place-order') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="firstname" value="{{ Auth::user()->name }}" class="form-control firstname" placeholder="Enter First Name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lastname" value="{{ Auth::user()->lname }}" class="form-control lastname" placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control email" placeholder="Enter Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control phone" placeholder="Enter Phone Number">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="address1">Address 1</label>
                                    <input type="text" name="address1" value="{{ Auth::user()->address1 }}" class="form-control address1" placeholder="Enter Address 1">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="address2">Address 2</label>
                                    <input type="text" name="address2" value="{{ Auth::user()->address2 }}" class="form-control address2" placeholder="Enter Address 2">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control city" placeholder="Enter City">
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" name="state" value="{{ Auth::user()->state }}" class="form-control state" placeholder="Enter State">
                                    <span id="state_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" value="{{ Auth::user()->country }}" class="form-control country" placeholder="Enter Country">
                                    <span id="country_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="pinCode">Pin Code</label>
                                    <input type="text" name="pinCode" value="{{ Auth::user()->pincode }}" class="form-control pinCode" placeholder="Enter Pin Code">
                                    <span id="pinCode_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            @if ($cartitems->count() > 0)
                                <h6>Order Details</h6>
                                <hr>
                                @php
                                    $total = 0;
                                @endphp
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <td>Name</td>
                                        <td>Qty</td>
                                        <td>Price</td>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartitems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>{{ $item->products->selling_price }}</td>
                                            </tr>
                                            @php
                                                $total += $item->prod_qty * $item->products->selling_price;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Grand Total <span class="float-end">Rs {{ $total }}</span></h6>
                                <hr>
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-success w-100">Pleace Order | COD</button>
                                <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay with Razorpay</button>
                                <button id="paypal-button-container"></button>
                            @else
                                <h4 class="text-center">No products in cart</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=AX7ytFpYgVGOx2HU_3FADRag3gutxaWkB4kS0VZIrJE_-Aya6FUg_gYXz4PMykBCteb2aPzHOG7gL9Cj"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{ $total }}' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            // const transaction = orderData.purchase_units[0].payments.captures[0];
            // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            var firstname = $('.firstname').val();
            var lastname = $('.lastname').val();
            var email = $('.email').val();
            var phone = $('.phone').val();
            var address1 = $('.address1').val();
            var address2 = $('.address2').val();
            var city = $('.city').val();
            var state = $('.state').val();
            var country = $('.country').val();
            var pinCode = $('.pinCode').val();
            $.ajax({
                type: "POST",
                url: "/place-order",
                data: {
                    'fname': firstname,
                    'lname': lastname,
                    'email': email,
                    'phone': phone,
                    'address1': address1,
                    'address2': address2,
                    'city': city,
                    'state': state,
                    'country': country,
                    'pinCode': pinCode,
                    'payment_mode': "Paid by PayPal",
                    'payment_id': orderData.id,
                },
                success: function (response) {
                // alert(responseb.status);
                    swal(response.status)
                    .then((value) => {
                        window.location.href = "/my-orders";
                    });
                }
            });
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');
      </script>
@endsection