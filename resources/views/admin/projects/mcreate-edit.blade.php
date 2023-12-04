@extends('layouts.admin')

@section('content')
    {{-- @if ($errors->any())
    <div class="alert alert-danger my-1" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    <div class="card card-project mx-3 my-3">
        <h5 class="card-header">{{ $title }}</h5>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger my-1" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="row g-3" action="{{ $route }}" method="{{ $method }}">
                @csrf
                <div class="col-12 ">
                    <label for="name" class="form-label">Nome Progetto: *</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Nome Progetto"
                        name="name"
                        value="{{ old('name') }}"
                        @error('name') is-invalid @enderror
                    >
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Data d'inizio: *</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="delivery_date" class="form-label">Data di scadenza: *</label>
                    <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                    @error('delivery_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 ">
                    <label for="description" class="form-label">Descrizione del progetto: </label>
                    <textarea
                        name="description"
                        id="description"
                        cols="191"
                        rows="10"
                        @error('description') is-invalid @enderror
                    >{{ old('description') }}</textarea>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 ">
                    <label for="steps" class="form-label">Passaggi: </label>
                    <input
                        type="text"
                        class="form-control"
                        id="steps"
                        placeholder="Passaggi"
                        name="steps"
                        value="{{ old('steps') }}"
                        @error('steps') is-invalid @enderror
                    >
                    @error('steps')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Aggiungi</button>
                    <button type="reset" class="btn btn-danger">Cancella</button>
                </div>

            </form>
            <div class="col-12 my-3">
                <a href="{{ route('admin.projects.index') }}">
                <button class="btn btn-secondary">Torna indietro</button></a>
            </div>
        </div>
    </div>

@endsection
