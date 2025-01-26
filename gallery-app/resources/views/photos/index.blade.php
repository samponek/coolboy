@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Zobrazení úspěšné zprávy po přidání nebo smazání fotky -->
    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulář pro přidání nové fotky -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title mb-4">Přidat novou fotku</h4>
            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Název fotky</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Zadejte název fotky" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image">Vyberte fotku</label>
                    <input type="file" name="image" id="image" class="form-control-file" required>
                </div>

                <button type="submit" class="btn btn-success">Přidat fotku</button>
            </form>
        </div>
    </div>

    <!-- Filtr pro hledání fotek podle názvu -->
    <div class="mb-4">
        <form action="{{ route('photos.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="Hledat fotky..." value="{{ request()->get('title') }}">
                <button class="btn btn-primary" type="submit">Filtruj</button>
            </div>
        </form>
    </div>

    

    <!-- Zobrazení fotek -->
    <div class="row">
    @foreach ($photos as $photo)
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Zobrazení fotky -->
                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="card-img-top" style="height: 200px; object-fit: cover;" />
                
                <div class="card-body">
                    <!-- Název fotky -->
                    <h5 class="card-title">{{ $photo->title }}</h5>

                    <!-- Tlačítka pro úpravu a smazání fotky -->
                    <div class="d-flex justify-content-between">
                        <!-- Tlačítko pro úpravu fotky -->
                        <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-warning">Upravit</a>

                        <!-- Formulář pro smazání fotky -->
                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Smazat</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

    <!-- Paginace pro stránkování -->
    <div class="d-flex justify-content-center">
        {{ $photos->links() }}
    </div>

</div>
@endsection
