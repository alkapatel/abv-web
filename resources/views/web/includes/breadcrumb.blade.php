@if(isset($breadcrumb))
<section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="breadcrumb__content text-center">
                    <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="{{route('web.index')}}">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>{{ (isset($breadcrumb))?$breadcrumb:'page'  }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endif