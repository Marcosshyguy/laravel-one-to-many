@extends('layouts.admin')

@section('title', 'Aggiungi progetto')

@section('content')
    <div class="container mt-3">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary" type="button>
            <i class="fa-solid
            fa-arrow-left"></i>
            Torna a Progetti
        </a>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-2 position-relative">
                <label for="title">Nome progetto</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="description">Descrizione progetto</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-2">
                <label for="type">Tipo di progetto</label>
                <div>
                    <select name="type_id" id="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="">Seleziona</option>
                        @foreach ($typeOfproject as $type)
                            <option value="{{ $type->id }}" @selected(old('type_id') == $type->id)>{{ $type->project_type }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="new_image">Immagine</label>
                <input type="file" class="form-control @error('new_image') is-invalid @enderror" id='new_image'
                    name="new_image" value="{{ old('new_image') }}">
                @error('new_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                {{-- preview --}}
                <div>
                    <p id="preview-text"></p>
                    <img src="" alt="" id="preview-image">
                </div>
            </div>



            <div class="mb-2">
                <label for="languages_used">Linguaggi utilizzati</label>
                <input type="text" class="form-control @error('languages_used') is-invalid @enderror" id="languages_used"
                    name="languages_used" value="{{ old('languages_used') }}">
                @error('languages_used')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-2">
                <label for="production_date">Data di produzione</label>
                <input type="date" class="form-control @error('production_date') is-invalid @enderror"
                    id="production_date" name="production_date" value="{{ old('production_date') }}">
                @error('production_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-dark" type="submit">Aggiungi</button>
        </form>
    </div>
@endsection
