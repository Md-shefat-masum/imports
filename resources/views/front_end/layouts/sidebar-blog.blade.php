@section('stylesheet')
<style>
  #myBtn {
    height: 200px;
    overflow: hidden;
  }

  #BtnHide {
    display: none;
  }

  #myBtn_two {
    height: 200px;
    overflow: hidden;
  }

  #BtnHide_two {
    display: none;
  }
</style>
@endsection

<div class="col-lg-3 col-md-12">

  <aside class="sidebar_widget sidebar_widget_two">
    <div class="widget_list widget_categories">
      <h3>Product categories</h3>
      <ul id="myBtn" style="">


        @foreach($categories as $cat)

        @php
        $jid = $cat['id'];
        $items = DB::table('products')->where('cat_id',$cat['id'])->where('status',1)->count();
        @endphp
        <li class="widget_sub_categories cat"><a href="" style="text-transform: uppercase;">{{ $cat['cat_name'] }} ({{ $items }}) </a>

          @if(count($cat['subcategories']))
          <ul class="widget_dropdown_categories" style="display: none;">
            @foreach($cat['subcategories'] as $scat)
            @php
            $items = DB::table('products')->where('sub_cat_id',$scat['id'])->where('status',1)->count();
            @endphp

            <li>

              <a class="get_subcat_product" href="/cat/{{$scat['id']}}">{{ $scat['name'] }}
                <input type="hidden" value="{{$scat['id']}}">
                <span>({{ $items }})</span></a>
            </li>
            {{-- <a href="/cat/{{$scat['id']}}">{{ $scat['name'] }} <span>({{ $items }})</span></a></li> --}}
        @endforeach
      </ul>
      @endif

      </li>
      @endforeach

      </ul>

    </div>
    <div class="text-center">
      {{-- <button onclick="myFunction()" id="myBtnTwo" class="btn btn-primary custom-btn">Read More</button> --}}
      <button id="BtnShow" class="btn btn-primary custom-btn">View More</button>
      <button id="BtnHide" class="btn btn-primary custom-btn">View less</button>

    </div>
  </aside>


</div>

@section('scripts')

<script>
  $('#BtnShow').click(function() {
    $('#myBtn').height('auto');
    $('#BtnShow').hide(0);
    $('#BtnHide').show(0);
});
$('#BtnHide').click(function() {
    $('#myBtn').height('200');
    $('#BtnShow').show(0);
    $('#BtnHide').hide(0);
});

</script>
<script>
  $('#BtnShow_two').click(function() {
    $('#myBtn_two').height('auto');
    $('#BtnShow_two').hide(0);
    $('#BtnHide_two').show(0);
});
$('#BtnHide_two').click(function() {
    $('#myBtn_two').height('200');
    $('#BtnShow_two').show(0);
    $('#BtnHide_two').hide(0);
});

</script>
<script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 700,
      values: [ 0, 3000 ],
      slide: function( event, ui ) {
        $( "#ammount_start" ).val( ui.values[ 0 ] );
        $( "#ammount_end" ).val(ui.values[ 1 ] );
        var ammount_start = $('#ammount_start').val();
        var ammount_end = $('#ammount_end').val();
      $.ajax({
                type: 'POST',
                url: '/product-price-range',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ammount_start": ammount_start,
                    "ammount_end": ammount_end
                },
                success: function(data) {
               
                    // console.log(data);
                    $("#productlist").html(data);
                   
                }
            })
      }
    });
 
  } );
</script>




@endsection