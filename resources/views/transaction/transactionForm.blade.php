@extends('layouts.app')
@section('content')
    {{--    {{dd($errors->messages())}}--}}
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <h3 class="card-header text-center">Create Transaction</h3>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data"
                                  action="{{ route('transaction-create') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input placeholder="amount" id="amount" class="form-control"
                                           name="amount"
                                           required
                                           autofocus>
                                    @if ($errors->has('amount'))
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <select id="to_user_id" class="form-control"
                                            name="to_user_id" required>

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                            >{{ $user->name }}</option>
                                        @endforeach
                                        @if ($errors->has('to_user_id'))
                                            <span class="text-danger">{{ $errors->first('to_user_id') }}</span>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group mb-3">

                                    <label class="form-label" for="inputFile">File:</label>

                                    <input

                                        type="file"

                                        name="files[]"

                                        id="inputFile"

                                        class="form-control @error('files') is-invalid @enderror" multiple>


                                    @error('files')

                                    @foreach($errors->messages() as $k=>$v)
                                        @if(\Illuminate\Support\Str::startsWith($k,"files"))
                                            <span class="text-danger">{{ $v[0] }}</span><br>
                                        @endif

                                    @endforeach

                                    <span class="text-danger">{{ $message }}</span>
                                    @if ($errors->has('files'))
                                        <span class="text-danger">{{ $errors->first('files') }}</span>
                                    @endif
                                    <span class="text-danger">{{ $message }}</span>
                                    @if ($errors->has('files.0'))
                                        <span class="text-danger">{{ $errors->first('files.0') }}</span>
                                    @endif

                                    @enderror

                                </div>
                                <div>
                                    <button type="submit" class="btn btn-dark btn-block">send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
