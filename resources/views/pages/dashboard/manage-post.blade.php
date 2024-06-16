@extends('layouts.theme')

@section('content')

    <section class="container">
        <h4>Manage Post</h4>  

        <manage-post :post-id="{{ isset($_GET['id']) ? $_GET['id'] : '' }}"></manage-post>

        <br><br>
    </section>
    
@endsection