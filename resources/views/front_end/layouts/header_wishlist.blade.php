{{-- @php
$auth_user = Auth::user();

@endphp
@if(isset($auth_user))
@php
$wishlist = DB::table('wish_lists')->where('user_id', $auth_user->id)->get();

@endphp --}}
<span class="wishlist_count">{{ count($countval) }}</span>
{{-- @else
<span class="wishlist_count">0</span>
@endif --}}