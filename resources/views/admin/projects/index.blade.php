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
    <div class="card card-project mx-3">
        <!-- Table Title -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Progetti</h5>
            <a class="add-project me-4" href="{{ route('admin.projects.create') }}">Aggiungi nuovo progetto</a>
        </div>
        <!-- /Table Title -->

        <!-- Table Content -->
        <div class="card-body">
          <table class="table ">
            <!-- Table Colons -->
            <thead>
              <tr>
                <td scope="col">Nome</td>
                <td scope="col">Technology</td>
                <td scope="col">Type</td>
                <td scope="col">Data di scadenza</td>
                <td scope="col">Data inizio</td>
                <td scope="col">Stato</td>
                <td scope="col">Azioni</td>
              </tr>
            </thead>
            <!-- /Table Colons -->
            <!-- Table Rows -->
            <tbody>
                @foreach ($projects as $project)
                    <!-- Date conversion & badge color -->
                    @php
                        $start_date = date_create($project->start_date);
                        $delivery_date = date_create($project->delivery_date);
                        if ($project->status === 'done')
                            $badge_bg = 'text-bg-success';
                        elseif ($project->status === 'failed')
                            $badge_bg = 'text-bg-danger';
                        else
                            $badge_bg = 'text-bg-warning';
                    @endphp
                    <tr>
                        <!-- Project name -->
                        <td>
                            <form action=" {{route('admin.projects.update', $project)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-hidden" value="{{ $project->name }}">
                            </form>
                        </td>
                        <!-- Technology name -->
                        <td>
                            @forelse ($project->technologies as $technology)
                                <a class="badge bg-gray text-white" href="#">{{ $technology->name }}</a>
                            @empty
                                -
                            @endforelse

                        </td>
                        <!-- Type name -->
                        <td>
                            <form action=" {{route('admin.projects.update', $project)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-hidden" value="{{ $project->type->name ?? ' - ' }}">
                            </form>
                        </td>
                        <!-- Project delivery date -->
                        <td>
                            <form action=" {{route('admin.projects.update', $project)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-hidden" value="{{ date_format($delivery_date, 'd/m/Y')}}">
                            </form>
                        </td>
                        <!-- Project start date -->
                        <td>
                            <form action=" {{route('admin.projects.update', $project)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-hidden" value="{{ date_format($start_date, 'd/m/Y')}}">
                            </form>
                        </td>
                        <!-- Project status -->
                        <td><span class="badge {{$badge_bg}}">{{ $project->status }}</span></td>
                        <!-- Project action buttons -->
                        <td>
                            <a href="{{ route('admin.projects.show', $project) }}"><button type="button" class="btn btn-success "><i class="fa-regular fa-eye"></i></button></a>
                            <a href="{{ route('admin.projects.edit', $project) }}"><button type="button" class="btn btn-warning "><i class="fa-regular fa-pen-to-square"></i></button></a>
                            @include('admin.partials.delete_button',[
                                'route' => route('admin.projects.destroy', $project),
                                'message' => 'Sei sicuro di voler eliminare questo progetto?'
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- /Table Rows -->
        </table>
        <!-- /Table Content -->
        {{ $projects->links() }}
        </div>
    </div>
    <!-- /Table -->
@endsection
