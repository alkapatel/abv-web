@extends('web.layout.app')
@section('content')
<!-- my account section start -->
<section class="my__account--section section--padding">
    <div class="container">
        <div class="my__account--section__inner border-radius-10 d-flex">
            <div class="account__left--sidebar">
                <h2 class="account__content--title mb-20">My Profile</h2>
                @include('web.includes.profileList')
            </div>
            <div class="account__wrapper">
                <div class="account__content">
                    <h2 class="account__content--title h2 mb-20"><i class="bi bi-dropbox text-secondary"></i> Orders History</h2>
                    <div class="account__table--area">
                        <table class="account__table">
                            <thead class="account__table--header">
                                <tr class="account__table--header__child">
                                    <th class="account__table--header__child--items">ORDER</th>
                                    <th class="account__table--header__child--items">DATE</th>
                                    <th class="account__table--header__child--items">STATUS</th>
                                    <th class="account__table--header__child--items">TOTAL</th>
                                    <th class="account__table--header__child--items">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="account__table--body mobile__none">
                                @foreach($ordData as $ord)
                                <tr class="account__table--body__child">
                                    <td class="account__table--body__child--items">#{{ $ord->id}}</td>
                                    <td class="account__table--body__child--items">{{date_format(date_create($ord->order_date),"F d Y")}}</td>
                                    <td class="account__table--body__child--items">{{$ord->order_status}}</td>
                                    <td class="account__table--body__child--items">₹{{$ord->total_amount}}</td>
                                    <td class="account__table--body__child--items"><a href="{{ route('view-order',['id' => $ord->id]) }}" class="primary__btn">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- my account section end -->
@endsection