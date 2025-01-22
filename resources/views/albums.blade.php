@extends('layouts.app')

@section('content')
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading mt-5">Stories of Hope and Humanity</h1>
                <p>
                In a world filled with challenges, the spirit of kindness and generosity can bring light to 
                those in need. This album captures the stories of individuals who are facing tough times but 
                are not defined by their struggles. Each story represents a journey filled with dreams, resilience, 
                and the hope of a brighter future. As you explore the faces and voices of these brave souls, we invite
                 you to become a part of their journey. Your support can turn their dreams into reality, one act of 
                 kindness at a time. Together, we can create a ripple of positive change.
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                  @foreach($albums as $album)
                  {{-- card --}}
                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <div id="carousel{{$album->id}}" class="carousel slide">
                        <div class="carousel-inner">
                          @foreach($album->media as $k => $media)
                          <div class="carousel-item {{ $k == 0 ? "active" : "" }}">
                            <div class="w-100 h-200px" style="background: #333 url('{{ asset('images/albums/'.$media->name)}}') center center no-repeat;background-size:cover;"></div>
                          </div>
                          @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$album->id}}" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$album->id}}" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                      <div class="card-body">
                          <h6 class="card-text"><b>{{$album->name}}</b></h6>
                          <small class="card-text text-italic">{{\Str::words(strip_tags($album->description), 10, '...')}}</small>
                          <div class="d-flex justify-content-between align-items-center">
                        </div>
                      </div>
                      <div class="card-footer d-flex justify-content-between bg-white text-end">
                        <a href="https://wa.me/?text=Checkout%20this%20amazing%20gallery%0A{{ route('home.album', $album->id) }}" class="btn btn-success btn-sm" target="_blank"><i class="fab fa-whatsapp fa-lg text-light"></i> Share</a>
                        <a href="{{ route('home.album', $album->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Read More</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <div class="d-flex justify-content-center mt-2">
                    {{ $albums->onEachSide(0)->links() }}
                  </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('javascript')
    <script></script>
@endsection
