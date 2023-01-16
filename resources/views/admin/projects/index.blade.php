@extends('layouts.admin')

@section('title', 'Progetti')

@section('content')
    <div class="container mt-3">
        <table class="table table-striped table-hover">
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>

                        <td>{{ $project->production_date }}</td>
                        <td class="description-text">{{ $project->description }}</td>
                        <td class="d-flex justify-content-center p-1">
                            <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-primary ">Mostra
                                dettagli</a>
                            <a href="{{ route('admin.projects.edit', $project->slug) }}"
                                class="btn btn-secondary ms-1">Aggiorna
                                progetto</a>
                            <a type="button" class="btn btn-danger ms-1" data-bs-toggle="modal"
                                data-bs-target="#delete-post-{{ $project->id }}">
                                Elimina progetto
                            </a>

                            {{-- Modal --}}
                            <div class="modal fade" id="delete-post-{{ $project->id }}" tabindex="-1"
                                aria-labelledby="delete-label-{{ $project->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="delete-label-{{ $project->id }}">Vuoi
                                                cancellare {{ $project->title }}?</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annulla</button>
                                            <form action="{{ route('admin.projects.destroy', $project->slug) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">
                                                    Cancella
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-info">Aggiungi progetto</a>
    </div>
@endsection
