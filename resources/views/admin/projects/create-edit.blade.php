@extends('layouts.admin')

@section('content')
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
            <form class="row g-3" action="{{ $route }}" method="POST">
                @csrf
                @method($method)

                <!-- Input project name -->
                <div class="col-12 ">
                    <label for="name" class="form-label">Nome Progetto *</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Nome Progetto"
                        name="name"
                        value="{{ old('name', $project?->name) }}"
                        @error('name')
                            class="is-invalid"
                        @enderror
                    >
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- /Input project name -->


                <!-- Input start date -->
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Data d'inizio *</label>
                    <input
                        type="date"
                        class="form-control is-invalid"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date', $project?->start_date) }}"
                    >
                    @error('start_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- /Input start date -->

                <!-- Input delivery date -->
                <div class="col-md-6">
                    <label for="delivery_date" class="form-label ">Data di scadenza *</label>
                    <input
                        type="date"
                        class="form-control is-invalid"
                        id="delivery_date"
                        name="delivery_date"
                        value="{{ old('delivery_date', $project?->delivery_date) }}"
                    >
                    @error('delivery_date')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- /Input delivery date -->

                <!-- Input technology -->
                <div class="col-md-12">
                    @foreach ($technologies as $technology)
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <input
                                name="technologies[]"
                                type="checkbox"
                                class="btn-check"
                                id="technology_{{ $technology->id }}"
                                autocomplete="off"
                                value="{{ $technology->id }}"
                                @if (($errors->any() && in_array($technology->id, old('technologies', [])))
                                    || (!$errors->any() && $project?->technologies->contains($technology)))
                                    checked
                                @endif
                            >
                            <label class="btn btn-outline-primary" for="technology_{{ $technology->id }}">{{ $technology->name }}</label>
                        </div>
                    @endforeach

                </div>
                <!-- /Input technology -->

                @if ($method === 'PUT')
                    <!-- Input status -->
                    <div class="col-md-4">
                        <label for="status" class="form-label">Stato del progetto *:</label>
                        <select id="status" class="form-select  is-invalid" name=status>
                        <option></option>
                        <option value="done">fatto</option>
                        <option value="in proccess">lavoro in progresso</option>
                        <option value="failed">non compiuto</option>
                        </select>
                    </div>
                    <!-- /Input status -->
                @endif



                <!-- Input description -->
                <div class="col-12 ">
                    <label for="description" class="form-label">Descrizione del progetto: </label>
                    <textarea
                        name="description"
                        id="description"
                        cols="191"
                        rows="10"
                        @error('description') is-invalid @enderror
                    >{{ old('description', $project?->description) }}</textarea>
                </div>
                <!-- /Input description -->

                <!-- Input steps -->
                <div class="col-12 ">
                    <label for="steps" class="form-label">Passaggi: </label>
                    <input
                        type="text"
                        class="form-control"
                        id="steps"
                        placeholder="Passaggio"
                        name="steps"
                        value="{{ old('steps', $project?->steps) }}"

                    >
                </div>
                <!-- /Input steps -->

                <!-- Form buttons -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Invio</button>
                    <button type="reset" class="btn btn-danger">Annulla</button>
                </div>
                <!-- /Form buttons -->

            </form>
            <div class="col-12 my-3">
                <a href="{{ route('admin.projects.index') }}">
                <button class="btn btn-secondary">Torna indietro</button></a>
            </div>
        </div>
    </div>

@endsection
