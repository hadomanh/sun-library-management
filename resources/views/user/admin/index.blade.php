@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Users</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    @if ($user->is_admin && !$user->is_blocked)
                        <td class="text-danger">{{ $user->name }}</td>
                    @elseif (!$user->is_admin && !$user->is_blocked)
                        <td class="text-primary">{{ $user->name }}</td>
                    @else
                        <td class="text-secondary">{{ $user->name }}</td>
                    @endif
                    
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin)
                            <a class="btn btn-outline-danger" href="{{ route('users.modify', [ $user->id, 'is_admin' => false, 'is_blocked' => false ]) }}">
                                {{ __('Revoke Admin') }}
                            </a>
                        @else
                            <a class="btn btn-outline-primary" href="{{ route('users.modify', [ $user->id, 'is_admin' => true, 'is_blocked' => false ]) }}">
                                {{ __('Grant Admin') }}
                            </a>
                        @endif

                        @if ($user->is_blocked)
                            <a class="btn btn-outline-secondary" href="{{ route('users.modify', [ $user->id, 'is_admin' => false, 'is_blocked' => false ]) }}">
                                {{ __('Unblock') }}
                            </a>
                        @else
                            <a class="btn btn-outline-danger" href="{{ route('users.modify', [ $user->id, 'is_admin' => false, 'is_blocked' => true ]) }}">
                                {{ __('Block') }}
                            </a>
                        @endif
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
      <br>
      <div class="ml-5">
        @include('pagination.default', ['paginator' => $users])
      </div>
</div>
@endsection

