@extends('layouts.theme')

@section('content')

    <section id="feature_category_section" class="feature_category_section section_wrapper">
        <div class="container">   
            <div class="row">
                <div class="col-md-9">
                    <single-post slug="{{ $slug }}" :user={{ auth()->check() ? auth()->user()->id : false }}></single-post>
                </div>
                <div class="col-md-3">
                    <latest-popular></latest-popular>
                </div>
            </div>
        </div>
    </section>
@endsection