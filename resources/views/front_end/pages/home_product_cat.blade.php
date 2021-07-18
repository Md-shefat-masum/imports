
<div id="category_products_section">
    <div class="home_section_style4 menu-image" v-for="(category, index) in categories" style="margin-top: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class="home_style4_inner">
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        <div class="category_menu" style="background-image: linear-gradient(rgba(11, 30, 57, 0.88), rgba(11, 30, 57, 0.88)),url({{asset('front_end/img/bg/banner112.jpg')}});background-position: center;background-size: 380px 497px;">

                            <div class="section_title s_title_style3">
                                <h2>@{{category.cat_info.cat_name}}</h2>
                            </div>
                            <div class="category_menu_content" v-if="category.subcategories.length > 0">
                                <ul>
                                    <li v-for="sub_cat in category.subcategories">
                                        <a class="get_home_subcat_product" :href="'/cat/'+sub_cat.id">
                                            @{{ sub_cat.name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <!--product area start-->
                        <div class="product_area row no-gutters">
                            <div class="col-12">
                                <div class="custom_paginate2">
                                    <pagination :show-disabled="true" :data="category.product" :limit="-1" @pagination-change-page="getResults2">
                                        <span slot="prev-nav" @click.prevent="get_prev_cat(category, index, $event)">&lt; Previous</span>
                                        <span slot="next-nav" @click.prevent="get_next_cat(category, index, $event)">Next &gt;</span>
                                    </pagination>
                                </div>
                            </div>
                            <article class="single_product col-lg-2 col-xl-2 col-md-4 col-sm-3" v-for="product in category.product.data">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" :href="'/porduct_details/'+product.id">
                                            <img :data-src="'/images/product/'+product.related_image[0]" v-if="!next_load"  alt="" class="lazy">
                                            <img :src="'/images/product/'+product.related_image[0]" v-else  alt="" class="lazy">
                                        </a>

                                        <div class="label_product">

                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="wishlist">
                                                    <a class="add_towishlist" type="submit" title="Add to Wishlist">
                                                        <input type="hidden" :value="product.id">
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                </li>

                                                <li class="quick_button">
                                                    <a :href="'/porduct_details/'+product.id" title="View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <div class="product_content_inner">
                                            <h4 class="product_name">
                                                <a href="'/porduct_details/'+product.id">@{{product.p_name}}</a>
                                            </h4>

                                            <div class="price_box home-cat">
                                                <span class="old_price" style="font-size: 12px;">
                                                    Unit Price: $@{{product.number_price}}
                                                </span>
                                            </div>
                                            <div class="price_box home-cat">

                                                <span class="current_price" style="display: inline-flex; font-size: 13px;">
                                                    Biding Price: $
                                                    <span>
                                                        <p>
                                                            <span>
                                                                @{{product.bid_price_your_bid}}
                                                            </span>
                                                        </p>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <form action="{{url('add-cart')}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="product_id" :value="product.id"
                                                id="product_id">
                                            <input type="hidden" name="product_name" :value="product.p_name"
                                                id="product_name">
                                            <input type="hidden" name="price" :value="product.bundle_price"
                                                id="price">
                                            <input type="hidden" name="quantity" value="1" id="quantity">
                                            <div class="add_to_cart">
                                                <input type="submit" v-if="product.status == 2" disabled class="btn btn-primary custom-btn" value="Sold Out">
                                                <input type="submit" v-else class="btn btn-primary custom-btn" value="Submit a Bid">
                                            </div>
                                        </form>

                                    </div>
                                </figure>
                            </article>
                        </div>
                        <!--product area end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


