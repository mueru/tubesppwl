@extends('layouts/main')

@section('container')
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded mb-3">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="https://source.unsplash.com/1050x450?cakes" class="d-block w-100" alt="cake">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="https://source.unsplash.com/1050x450?juice" class="d-block w-100" alt="drinks">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="https://source.unsplash.com/1050x450?hamburger" class="d-block w-100" alt="steak">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="https://source.unsplash.com/1050x450?soup" class="d-block w-100" alt="soup">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="https://source.unsplash.com/1050x450?muffin" class="d-block w-100" alt="muffin">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <h3>Welcome To MyResepi</h2>
            <p>Find & Share how to make delicious dishes <a href="/posts" class="text-decoration-none" >here</a></p>
    </div>
    <div>
    </div>

    
@endsection
