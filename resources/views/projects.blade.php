@extends('layouts.app')

@section('title', 'Projects | CLIENTFLOW')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Projects</h1>
            <p class="text-muted small mb-0">Track and manage project deliverables.</p>
        </div>
        @can('create project')
        <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
            <i class="bi bi-plus-lg me-2"></i> Add Project
        </button>
        @endcan
    </header>

    <div class="custom-table-container">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Budget</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $project->name }}</div>
                        <div class="text-muted smaller" style="font-size: 11px;">{{ $project->category ?? 'General' }}</div>
                    </td>
                    <td>{{ $project->client->name }}</td>
                    <td><span class="badge {{ strtolower($project->status) == 'active' ? 'badge-active' : (strtolower($project->status) == 'completed' ? 'badge-completed' : 'badge-pending') }}">{{ $project->status }}</span></td>
                    <td>{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('M d, Y') : 'N/A' }}</td>
                    <td>${{ number_format($project->budget, 0) }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm text-muted"><i class="bi bi-pencil"></i></button>
                        @can('delete project')
                        <button class="btn btn-sm text-muted"><i class="bi bi-trash"></i></button>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No projects found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @can('create project')
    <!-- Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('projects') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">New Project</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Project Name</label>
                            <input type="text" name="name" class="form-control" placeholder="E.g. Website Redesign" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Client</label>
                                <select name="client_id" class="form-control" required>
                                    @foreach(\App\Models\Client::all() as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Budget</label>
                                <input type="number" name="budget" class="form-control" placeholder="5000" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-primary">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
@endsection
