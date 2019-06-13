@extends('layouts.app', ['title' => __('Public Holiday Management')])

@section('content')
    @include('layouts.headers.card')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Public Holidays') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('publicholiday.create') }}" class="btn btn-sm btn-primary">{{ __('Add') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">{{ __('Public Holiday') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Date Created') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($publicholidays as $publicholiday)
                                    <tr>
                                        <td class="text-center">{{ $publicholiday->publicholiday }}</td>
                                        <td class="text-center">{{ $publicholiday->date }}</td>
                                        <td class="text-center">{{ $publicholiday->created_at->format('d/m/Y') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                       
                                                    <form action="{{ route('publicholiday.destroy', ['publicholiday' => $publicholiday ]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        <a class="dropdown-item" href="{{ route('publicholiday.edit', ['publicholiday' =>$publicholiday ]) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this category?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>    
                                           
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            @endforeach   
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                             {{ $publicholidays->links() }} 
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection