@extends('web.layout.app')
@section('content')
<!-- Start breadcrumb section -->
<section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="breadcrumb__content text-center">
                    <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>My Account</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb section -->

<!-- my account section start -->
<section class="my__account--section section--padding">
    <div class="container">
        <div class="my__account--section__inner border-radius-10 d-flex">
            <div class="account__left--sidebar">
                <h2 class="account__content--title h3 mb-20">My Profile</h2>
                <ul class="account__menu">
                    <li class="account__menu--list"><a href="my-account.html">Dashboard</a></li>
                    <li class="account__menu--list active"><a href="my-account-2.html">Addresses</a></li>
                    <li class="account__menu--list"><a href="wishlist.html">Wishlist</a></li>
                    <li class="account__menu--list"><a href="login.html">Log Out</a></li>
                </ul>
            </div>
            <div class="account__wrapper">
                <div class="account__content">
                    <h2 class="account__content--title h3 mb-20">Addresses</h2>
                    <button class="new__address--btn primary__btn mb-25" type="button">Add a new address</button>
                    <div class="account__details two">
                        <h3 class="account__details--title h4">Default</h3>
                        <p class="account__details--desc">Admin <br> Dhaka <br> Dhaka 12119 <br> Bangladesh</p>
                        <a class="account__details--link" href="my-account-2.html">View Addresses (1)</a>
                    </div>
                    <div class="account__details--footer d-flex">
                        <button class="account__details--footer__btn" type="button">Edit</button>
                        <button class="account__details--footer__btn" type="button">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- my account section end -->

@endsection