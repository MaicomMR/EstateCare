@extends('adminlte::page')

@section('title', 'Adicionar novo patrimônio')

@section('content_header')

    <link rel="stylesheet" type="text/css" href="css/adminStyle.css">

@stop



@section('content')
    <h3>Listagem de Patrimônios</h3>

    <!-- Header Menu -->
    @include('admin.estates.headerMenu')

    @if(session()->has('message'))

        <div class="alert alert-warning" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif

    <form action="{{route('estateSearchByName')}}">
        <div class="input-group mb-3 m-1">
            <input type="text" class="form-control" placeholder="Buscar patrimônio por nome" aria-label="" aria-describedby="basic-addon1" name="estateNameLike">
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    <div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">patrimônio</th>
                        <th scope="col">nome</th>
                        <th scope="col">valor</th>
                        <th scope="col">categoria</th>
                        <th scope="col">sub-categoria</th>
                        <th scope="col">fornecedor</th>
                        <th scope="col">ações</th>
                    <tr>
                    </thead>


                    @foreach($EstateList as $Estate)

                        <tr>
                        <td scope="row" class="text-right">
                            {{$Estate->label_id}}
                        </td>
                        <td scope="row">{{$Estate->name}}</td>
                        <td scope="row">{{number_format($Estate->value, 2, ',', ' ')}} R$</td>
                        <td scope="row">{{$Estate->category->name}}</td>
                        <td scope="row">{{$Estate->subcategory->name}}</td>
                        <td scope="row">
                            @if($Estate->seller)
                                {{$Estate->seller->name}}
                            @endif

                        </td>

                        <td scope="row" class="text-right">
                            {{--    Assurance cover estate icon   --}}
                            @if($Estate->assurance_cover_date > now())
                            <button type="button" class="btn btn-warning">
                                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                            </button>
                            @endif

                            {{--    Edit estate button   --}}
                            <a class="btn btn-primary" href="{{ route('estateEdit', $Estate->id)}}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            {{--    Delete estate button   --}}
                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#confirmDeleteModal"
                               onclick="deleteData({{$Estate}})">
                                <i class="fas fa-trash-alt"></i>
                            </a>

                            {{--    Assign to employee button   --}}
                            @if($Estate->employee_id)
                                <a href="{{route('employeeProfile', $Estate->employee_id)}}">
                                    <button type="button" class="btn btn-secondary">
                                        <i class="fas fa-user-tag"></i>
                                    </button>
                                </a>
                            @else
                                <a class="btn btn-success" href="#" data-toggle="modal"
                                   data-target="#confirmAssignModal"
                                   onclick="assignDataToEmployee({{$Estate}})">
                                    <i class="fas fa-user-plus"></i>
                                </a>
                            @endif

                            {{-- Confirm delete modal --}}
                            @include('admin.estates.estateConfirmDeleteModal')

                            {{-- Confirm assign modal --}}
                            @include('admin.estates.estateConfirmAssignModal')
                        </td>
                        </tr>
                    @endforeach

                </table>
                {{ $EstateList->links() }}

            </div>
        </div>
    </div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/adminStyle.css">
@stop



