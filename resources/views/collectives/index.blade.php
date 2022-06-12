@extends('layouts.app')


@section('title')
    My Collective | Mni Slack
@endsection


 @section('content')
           
           <div class="container">
                 <div class="row justify-content-center my-5">
                     <div class="col-md-8">
                           <div class="card mt-3">
                               <div class="card-header text-center">{{ __('My Collective')}}</div>
                                  <table class="table table-hover table-stripped">
                                           <thead>
                                                   <tr>
                                                       <th>Id</th>
                                                       <th>Title</th>
                                                       <th>Question</th>
                                                       <th>Operation</th>
                                                   </tr>
                                           </thead>
                                       
                                            @foreach ($collectives as $key => $collective)
                                            <tr>
                                                  <td>{{$key+=1}}</td>
                                                  <td>{{$collective->title}}</td>
                                                  <td>
                                                      <span class="badge bg-success">
                                                       {{$collective->question()->count()}}
                                                       </span>
                                                  </td>
                                                  <td class="d-flex justify-content-center align-items-center">
                                                          <a href="{{route('collectives.show',$collective)}}" class="btn btn-sm btn-primary">
                                                             <i class="fas fa-eye"></i>
                                                          </a>    
                                         
                                                          <a href="{{route('collectives.edit',$collective)}}" class="btn btn-sm btn-warning mx-2">
                                                              <i class="fas fa-edit"></i>
                                                          </a>
                                                              <form id="{{$collective->id}}" action="{{route('collectives.destroy',$collective)}}" method="post">
                                                                           @csrf
                                                                                     @method('DELETE')
                                           
                                                               </form> 
                                                                       <a href="#" onclick="if (confirm('are you sure ?'))document.getElementById('{{$collective->id}}').submit()" class="btn btn-sm btn-danger">
                                                                               <i class="fas fa-trash"></i>
                                                                       </a>  

                                                  </td>
                                            </tr>
                                            @endforeach

                                  </table> 
                            <div class="d-flex justify-content-center">
                                         {{$collectives->links()}}
                                   </div> 

                           </div>
                     </div>    

                 </div>
            </div>


 @endsection



