@extends('layouts.theme')

@section('content')

    <section id="feature_category_section" class="feature_category_section section_wrapper">
        <div class="container">   
            <div class="row">
                <div class="col-md-9">
                    <category-posts id="{{ $id }}"></category-posts>
                </div>
                <div class="col-md-3">
                    <latest-popular></latest-popular>
                </div>
            </div>
        </div>
    </section>
@endsection