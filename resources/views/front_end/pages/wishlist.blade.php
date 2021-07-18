@extends('front_end.layouts.master')
@section('title', '|Product')
@section('stylesheet')

@endsection
@section('content')
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="/">home</a></li>
                        <li>Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cart_page_bg" id="wishlist-results">
    <div class="container">
        <div class="shopping_cart_area">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            {{-- <th class="product_name">Wish List</th> --}}
                                            <th class="product-price">Price</th>
                                            <th class="product-price">Bundle Price</th>
                                            <th class="product_remove">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="wishlist_remove">
                                        @php
                                        $auth_user = Auth::user();

                                        @endphp
                                        @if(isset($auth_user))
                                        @php
                                        $wishlist = DB::table('wish_lists')->where('user_id', $auth_user->id)->get();

                                        @endphp
                                        @foreach ($wishlist as $data)
                                        @php
                                        $sp = DB::table('products')->where('id', $data->product_id)->first();
                                        @endphp
                                        @php
                                        $val= $sp->image;
                                        $v=json_decode($val);
                                        @endphp

                                        <tr>
                                            <td class="product_thumb"><a href="#"><img
                                                        src="{{ asset('images/product') }}/{{$v[0]}}" alt=""></a></td>
                                            <td class="product_name"><a href="#">{{$sp->p_name}}</a></td>
                                            <td class="product-price">$ {{$sp->price}}</td>
                                            <td class="product-price">$ {{$sp->bundle_price}}</td>
                                            <td class="product_remove"><a type="submit" class="remove_wishlist">
                                                    <input type="hidden" value={{$data->id}}>
                                                    <i class="fa fa-trash-o"></i></a>
                                            </td>


                                        </tr>


                                        @endforeach
                                        @else

                                        @endif

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection