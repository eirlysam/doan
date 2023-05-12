@extends('layout') 
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('pages.include.slidebar')
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Liên hệ chúng tôi</h2>
                    <div class="row">
                        @foreach($contact as $key => $cont)
                        <div class="col-md-12">
                            {!!$cont->info_contact!!}
                        </div>
                        <div class="col-md-12">
                            <h4>Bản đồ</h4>
                            {!!$cont->info_map!!}
                        </div>
                        @endforeach
                    </div>
                                         
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection