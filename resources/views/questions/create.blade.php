@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-header text-center">{{ __('Create Collective') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('questions.store') }}">
                        @csrf
                              <div class="row mb-3">
                                    <label for="collective_id" class="col-md-4 col-form-label text-md-end">{{ __('Coolective') }} <span class="text-danger fw-bold">*</span></label>
                                     <div class="col-md-6">
                                         <select name="collective_id" id="collective_id"  class="form-select form-control @error('collective_id') is-invalid @enderror">
                                          <option disable selected>Chhose Collective </option>  
                                         @foreach($collectives as $collective) 
                                            <option value="{{$collective->id}}">
                                                  {{$collective->title}}
                                             </option>
                                             @endforeach
                                         </select>
                                            @error('collective_id')
                                              <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                              </span>
                                             @enderror
                                     </div>


                              </div>

                              <div class="row mb-3">
                                    <label for="category_id" class="col-md-4 col-form-label text-md-end">{{ __('Coolective') }} <span class="text-danger fw-bold">*</span></label>
                                     <div class="col-md-6">
                                         <select name="category_id" id="category_id"  class="form-select form-control @error('category_id') is-invalid @enderror">
                                          <option disable selected>Chhose Category</option>
                                             @foreach($categories as $category)
                                              <option value="{{$category->id}}">
                                                  {{$category->name}}
                                              </option>
                                            @endforeach
                                                  
                                         </select>
                                         @error('collective_id')
                                              <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                              </span>
                                         @enderror
                                     </div>


                              </div>

                               
                              <div class="row mb-3">
                                    <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }} <span class="text-danger fw-bold">*</span></label>

                                      <div class="col-md-6">
                                           <input id="name" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                           </span>
                                        @enderror
                                      </div>
                               </div>

                               <div class="row mb-3">
                                   <label for="body" class="col-md-4 col-form-label text-md-end">{{ __('body') }} <span class="text-danger fw-bold">*</span></label>

                                     <div class="col-md-6">
                                          <textarea rows="5" cols="30"  class="form-control @error('body') is-invalid @enderror" name="body"  required autocomplete="body">{{ old('body') }}</textarea>

                                           @error('body')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                       </div>
                                </div>

                                <div class="row mb-0">
                                       <div class="col-md-6 offset-md-4">
                                           <button type="submit" class="btn btn-primary">
                                                {{ __('Save') }}
                                          </button>
                                     </div>
                                </div>


                      

                  </form>  
             </div>
        
         </div>
    </div>
        
</div>  
       
@endsection         