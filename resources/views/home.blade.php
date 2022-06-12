@extends('layouts.app')
@section('title')
   Mini | Mini Stack
   @endsection

@section('content')

       <div class="container">
           <div class="row my-5">
                 <div class="col-md-8">
                   <div class="card mt-3">
                        <div class="card-header">
                            {{__('Home')}}
                        </div>   
                   </div>

                 </div>
                 <div class="col-md-4">
                     <div class="card mt-3">
                         <div class="card-header">
                             {{__('Home')}}
                         </div>
                     </div>
                 </div>


           </div>
       </div>


       @endsection