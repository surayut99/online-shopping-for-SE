@extends ('layouts.main')

@section('content')
<div class="container" style="margin-top: 100px;font-family: 'Bai Jamjuree', sans-serif;">
  {{-- <h1>This is all our stores</h1> --}}
  @for($i=0; $i<sizeof($stores) ; $i++) <div class="card m-2" style="width: 18rem;" width="150px">
    <img src="{{ asset("storage/pictures/icon/default_store.png")}}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $stores[$i]->store_name }}</h5>
      <p class="card-text">{{ $stores[$i]->store_description }}</p>
      <a href="{{ route('stores.show', ['store' => $stores[$i]->store_id])}}" class="btn btn-primary">ไปหน้าร้าน</a>
    </div>
</div>
@endfor

<hr>
</div>
@endsection
