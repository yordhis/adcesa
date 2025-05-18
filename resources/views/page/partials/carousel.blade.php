

<div id="carousel_1" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('/src/images/b-1.png') }}" class="d-block w-100 img-banner" alt="Banner 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('/src/images/b-2.png') }}" class="d-block w-100 img-banner" alt="Banner 2">
      </div>
      {{-- <div class="carousel-item">
        <img src="{{ asset('/src/images/high 1.jpg') }}" class="d-block w-100 img-banner" alt="Banner 3">
      </div> --}}
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_1" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel_1" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
