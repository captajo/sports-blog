@extends('layouts.theme')

@section('content')

    <slider-carousel></slider-carousel>

    <section id="feature_category_section" class="feature_category_section section_wrapper">
        <div class="container">   
            <div class="row">
                <div class="col-md-9">
                    <category-news></category-news>
                </div>
                <div class="col-md-3">
                    <latest-popular></latest-popular>
                </div>
            </div>
        </div>
    </section>
@endsection