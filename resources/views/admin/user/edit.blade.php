@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Editing users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Main</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Editing users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="post" class="w-25">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name of user"
                                       value="{{ $user->name }}">
                            </div>
                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Email"
                                       value="{{ $user->email }}">
                            </div>
                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="form-group w-50">
                                <label>Choose role</label>
                                <select name="role" class="form-control">
                                    @foreach($roles as $id => $role)
                                        <option value="{{ $id }}"
                                            {{ $id == $user->role ? ' selected' : '' }}
                                        >{{ $role }}</option>
                                    @endforeach
                                </select>

                                @error('role')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group w-50">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </div>

                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
