@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <online-users></online-users>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-md-offset-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
                <div class="panel-footer">Panel footer</div>
            </div>
        </div>
    </div>
</div>
@endsection
