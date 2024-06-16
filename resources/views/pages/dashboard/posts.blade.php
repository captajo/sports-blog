@extends('layouts.theme')

@section('content')

    <section class="container">
        <h4>My Posts</h4>  

        @if (isset($_GET['status']) && in_array($_GET['status'], ['created', 'updated'])) 
            <div class="alert alert-success">
                Your post has been successfully {{ $_GET['status'] }}
            </div>
        @endif

        <div class="text-right mb-4">
            <a href="{{ route('manage-post') }}"><button class="btn btn-primary">Create New Post</button></a>
        </div>

        <my-posts></my-posts>

        <br><br>
    </section>
    
@endsection