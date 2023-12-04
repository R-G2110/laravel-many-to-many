@extends('layouts.admin')

@section('content')

    <!-- Delete message -->
    @if (session('deleted'))
        <div class="alert alert-success mt-3 mx-3" style="height: 50px" role="alert">
            <p>{{ session('deleted') }}</p>
        </div>
    @endif
    <!-- /Delete message -->

    <!-- Table -->
    <div class="card card-type my-3 mx-3 w-50">
        <!-- Table Title -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Progetti</h5>
            <a class="add-type me-4" href="{{ route('admin.types.create') }}">+Aggiungi nuova type</a>
        </div>
        <!-- /Table Title -->

        <!-- Table Content -->
        <div class="card-body">
          <table class="table ">
            <!-- Table Colons -->
            <thead>
              <tr>
                <td class="w-85" scope="col">Nome</td>
                <td class="text-center" scope="col">Azioni</td>
              </tr>
            </thead>
            <!-- /Table Colons -->
            <!-- Table Rows -->
            <tbody>
                @foreach ($types as $type)

                    <tr>
                        <!-- type name -->
                        <td>
                            <form action=" {{route('admin.types.update', $type)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-hidden" value="{{ $type->name }}">
                            </form>

                        </td>
                        <!-- type action buttons -->
                        <td>
                            <a href="{{ route('admin.types.index', $type) }}"><button type="button" class="btn btn-warning "><i class="fa-regular fa-pen-to-square"></i></button></a>
                            @include('admin.partials.delete_button',[
                                'route' => route('admin.types.destroy', $type),
                                'message' => 'Sei sicuro di voler eliminare questo tipo?'
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- /Table Rows -->
        </table>
        <!-- /Table Content -->
        </div>
    </div>
    <!-- /Table -->
@endsection
