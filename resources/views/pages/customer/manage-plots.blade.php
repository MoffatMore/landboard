@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="container-fluid " style="margin-top: 100px">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">My Plots</h4>
            </div>
            <div class="card-body">
                @isset($plots)
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Plot Number</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plots as $plot)
                        <tr>
                            <!-- Modal -->
                            <div class="modal fade" id="model{{ $plot->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitle{{ $plot->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post"
                                          action="#">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Transfer Plot</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Plot No</label>
                                                    <input type="text" name="plot_no" id="" class="form-control"
                                                           placeholder="" aria-describedby="helpId" readonly
                                                           value="{{ $plot->plot_no }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Location</label>
                                                    <input type="text" name="location" id="" class="form-control"
                                                           placeholder="" aria-describedby="helpId" readonly
                                                           value="{{ $plot->location }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <input type="text" name="plot_address" id="" class="form-control"
                                                           placeholder="" aria-describedby="helpId" readonly
                                                           value="{{ $plot->address }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Transferee</label>
                                                    <select class="form-control form-control-sm" name="transferee" id="" size="1">
                                                        <option>More</option>
                                                        <option>Bash</option>
                                                        <option>Buno</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <td class="text-center">{{ $plot->id }}</td>
                            <td>{{ $plot->location }}</td>
                            <td>{{ $plot->address }}</td>
                            <td>{{ $plot->plot_no }}</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon"
                                        data-toggle="modal" data-target="#model{{ $plot->id }}">
                                    <i class="fa fa-exchange" ></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    @else
                    <div class="alert alert-warning" role="alert">
                        <strong>No plots at the moment!</strong>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@stop