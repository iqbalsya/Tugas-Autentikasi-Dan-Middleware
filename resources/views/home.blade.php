@extends('layouts.master')
@section('title', 'Home')

@section('content')

<div class="container col-xxl py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-4">
        <img src="{{ asset('img/redvelvet.jpg') }}" width="300" height="300" class="d-block mx-lg-auto float-end img-fluid rounded" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-8">
        <h4>Experience the Luxurious Taste of</h4>
        <h1 class="display-5 fw-bold lh-1 mb-3">🌟Red Velvet Latte🌟</h1>
        <p>Selamat datang di dunia kenikmatan yang memesona! Mari jelajahi sensasi tak terlupakan bersama Red Velvet, minuman yang menggoda dengan kelembutan dan cita rasa manisnya yang istimewa. Nikmati setiap tegukan yang memanjakan Anda dengan kehangatan dan kenikmatan yang tak terlupakan. Segera rasakan sensasi menggugah selera dari Red Velvet di setiap detiknya! ☕✨</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="{{ route('product.index') }}"type="button" class="btn btn-info btn-md px-4 me-md-2">Buy Now!</a>
        </div>
      </div>
    </div>
  </div>

  @endsection
