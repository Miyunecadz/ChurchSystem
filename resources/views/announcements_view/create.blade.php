@extends('layouts.master')
@section('title','Add New Announcement')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <i class="fas fa-plus me-1"></i>
                Add New Announcement
            <a onclick="return confirm('Are you sure to leave this page? - Data you have entered may not be saved.')" href="{{url('announcements')}}" class="float-right btn btn-sm btn-info shadow-sm">Go Back</a>
        </div>
        <div class="card-body">
             @if(Session::has('msg'))
                <div class="alert alert-success">
                    {{session('msg')}}
                </div>
            @endif
 
            <form method="post" action="{{url('announcements')}}">
                @csrf
                <table class="table table-hover">
                    <tr>
                        <th>Title</th>
                        <td>
                            <input type="text" name="title" class="form-control" value="{{ (old('title')) }}" required>
                        </td>
                    </tr> 
                    <tr>
                        <th>Description</th>
                        <td>
                            <input type="text" name="description" class="form-control" value="{{ (old('description')) }}" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>
                            <input type="text" name="location" class="form-control" value="{{ (old('location')) }}" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>
                            <input type="time" name="time" class="form-control" value="{{ (old('time')) }}" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>
                            <input type="date" name="date" class="form-control" value="{{ (old('date')) }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-primary btn-block" value="Submit" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

@endsection