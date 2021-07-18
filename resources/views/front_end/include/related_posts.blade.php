
@if(App\RelatedForum::where("blog_id",$blog_id)->exists())
<div class="card" style="margin-top: 50px;">
    <div class="card-header">
        <h4>Related Posts</h4>
    </div>
    <div class="card-body">
        <div class="row">
            @php $blog=App\RelatedForum::where("blog_id",$blog_id)->first(); @endphp
            @foreach(json_decode($blog->related_blog) as $item)
              @if(App\Blog::where("id",$item)->exists())
              @php $item = App\Blog::where("id",$item)->first(); @endphp
              <div class="col-lg-3 col-md-4 col-12">
                  <article class="single_product">
                      <figure>
                          <div class="product_thumb product_thumb_two">
                              <a class="primary_img" href="{!! url('blog-details/'.$item->id) !!}">
                                  <img style="height: unset;" src="/images/blog/{{$item->image}}" alt="" />
                              </a>

                              <div class="label_product"></div>
                              <div class="action_links">
                                  <ul>
                                      <li class="quick_button">
                                          <a href="{!! url('blog-details/'.$item->id) !!}" data-original-title="" title=""><i class="ion-ios-search-strong"></i></a>
                                      </li>
                                  </ul>
                              </div>
                          </div>

                          <div class="product_content grid_content">
                              <div class="product_content_inner">
                                  <h4 class="product_name product_name_two">
                                      <a href="{!! url('blog-details/'.$item->id) !!}">{{ substr(strip_tags($item->title), 0,30) }}....</a>
                                  </h4>

                                  <div class="price_box" style="padding: 20px 0px 0px 0px;">
                                      <div class="current_price_two">
                                          <span class="current_price"> <a href="{!! url('blog-details/'.$item->id) !!}"> Read More</a></span>
                                          <br />
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </figure>
                  </article>
              </div>
              @endif
            @endforeach
        </div>
    </div>
</div>
@endif
