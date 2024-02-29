<?php $current_params = Route::current()->parameters();
$crrSlug =  (is_array($current_params))?$current_params['slug']:'';
?>
<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Categories</h2>
    <ul class="widget__categories--menu">
        @foreach($Catdata as $cat)
        <li class="widget__categories--menu__list {{ ($crrSlug == $cat->cat_slug)?'active':'' }}">
            <label class="widget__categories--menu__label d-flex align-items-center">
                <img class="widget__categories--menu__img" src="{{ asset('web/assets/img/categories/') }}/{{$cat->cat_img}}" alt="categories-img">
                <a href="{{ URL::to('product-category/') }}/{{$cat->id}}">
                    <span class="widget__categories--menu__text">{{ substr($cat->category_name,0,15) }}...({{$cat->pro_count}})</span>
                </a>
                <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                    <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                </svg>
            </label>
            <ul class="widget__categories--sub__menu" style="{{ ($crrSlug == $cat->cat_slug) ? 'display: block' : 'display: none' }}">
                <?php $pro_id=''; $i=0;?>
                @foreach($productData as $pro)
                    @if ($cat->id==$pro->category_id && $pro_id!=$pro->id)
                    <li class="widget__categories--sub__menu--list">
                        <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{ URL::to('product-category') }}/{{$cat->cat_slug}}">
                            <!-- <img class="widget__categories--sub__menu--img" src="{{ asset('web/assets/img/product/small-product/product2.webp') }}" alt="categories-img"> -->
                            <span class="widget__categories--sub__menu--text">{{ substr($pro->product_name,0,22) }}...</span>
                        </a>
                    </li>
                    @else
                    @endif
                    <?php $pro_id=$pro->id; ?>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>