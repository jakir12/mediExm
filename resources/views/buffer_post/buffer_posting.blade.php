@extends('layouts.app')
@section('content')
<div class="container-fluid app-body app-home">

    <div class="row">
        <div style="margin-top: 10px;">
            <form method="get" action="{{URL::to('search-recentPost')}}">
                <div class="row" style="margin-left: 0px;">
                    <div class="col-md-3">
                        <div class="group">
                            <div class="input-group">
                                <input type="text" name="post_text" class="form-control" placeholder="Search" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="group">
                                <input type="date" name="sent_at" class="form-control">
                            </div>
                        </div>   
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="group">
                                <select name="group_id" class="form-control" style="width: 100%">
                                    <option value="0">All Group</option>
                                    @foreach($social_groups as $grp)
                                    <option value="{{$grp->id}}">{{$grp-> name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="search" class="btn btn-success">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-bordered"> 
            <thead> 
                <tr> 
                    <th>SL</th>
                    <th>Group Name</th>
                    <th>Group Type</th> 
                    <th>Account Name</th> 
                    <th>Post Text</th> 
                    <th>Time</th> 
                </tr> 
            </thead> 
            <tbody> 
                @foreach($buffer_postings as $key => $bp)
                <tr> 

                    <td>{{$bp->id}}</td> 
                    <td>{{$bp->name}}</td> 
                    <td>{{$bp->type}}</td> 
                    <td><img src="{{$bp->avatar}}" style="width: 50px;height: 50px;border-radius: 50%"/></td> 
                    <td>{{$bp->post_text}}</td>
                    <td>{{$bp->sent_at}}</td>
                </tr>
                @endforeach
            </tbody> 
        </table>
        {{ $buffer_postings->appends(Request::except('page'))->links() }}
    </div>
</div>
@endsection