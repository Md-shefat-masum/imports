{{-- <tbody id="wishlist_remove"> --}}
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

{{-- </tbody> --}}