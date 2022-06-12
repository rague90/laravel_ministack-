@extends('layouts.app')


@section('title')
    {{$collective->title }} | Mni Slack
@endsection
@section('content')
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-md-10">
                     <div class="card mt-3">
                           <div class="card-header text-center"> {{$collective->title}}</div>
                           <div class="card-body">
                               <ul class="list-group">
                                     @foreach($collective->question as $question)
                                     <li class="list-group-item list-group-item-action">
                                        <a href="{{route('questions.show',$question)}}" class="btn btn-link text-decoration-none text-primary">
                                               {{$question->title}}

                                            </a>
                                     </li>
                                     @endforeach
                               </ul>
                           </div>

                     </div>
                </div>

            </div>
        </div>
@endsection
