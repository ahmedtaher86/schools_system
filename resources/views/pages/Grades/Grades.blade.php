@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.Grades') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>

@if ($massages = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{$massages}}</strong>
    </div>
    
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

  <div class="row">   
    <div class="col-xl-12 mb-30">     
      <div class="card card-statistics h-100"> 
        <div class="card-body">

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('Grades_trans.add_Grade') }}
            </button>
            <br><br>
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('Grades_trans.stage_name_en') }}</th>
                    <th>{{ trans('Grades_trans.stage_name_ar') }}</th>
                    <th>{{ trans('Grades_trans.Notes') }}</th>
                    <th>{{ trans('Grades_trans.Processes') }}</th>
               
                </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                </tr>    --}}
                @foreach ( $Grades as $key => $Grade )
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$Grade['name_en']}}</td>
                    <td>{{$Grade['name_ar']}}</td>
                    <td>{{$Grade['notes']}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" title="{{trans('Grades_trans.Edit')}}" data-toggle="modal" data-target="#edit{{$Grade->id}}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" title="{{trans('Grades_trans.Delete')}}" data-toggle="modal" data-target="#delete{{$Grade->id}}">
                            <i class="fa fa-trash"></i>
                        </button>

                    </td>
                  
                </tr>  

<!-- Edit_modal_Grade -->
<div class="modal fade" id="edit{{$Grade->id}}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
               id="exampleModalLabel">
               {{trans('Grades_trans.Edit')}}
           </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <div class="modal-body">
           <!-- add_form -->
           <form action="{{url("Grades/$Grade->id")}}" method="POST">
                @method('PUT')
               @csrf
               <div class="row">
                   <div class="col">
                       <label for="name_ar"
                              class="mr-sm-2">{{trans('Grades_trans.stage_name_ar')}}
                           :</label>
                       <input id="name_ar" type="text" name="name_ar" class="form-control" value="{{$Grade->name_ar}}">
                   </div>
                   <div class="col">
                       <label for="name_en"
                              class="mr-sm-2">{{trans('Grades_trans.stage_name_en')}}
                           :</label>
                       <input type="text" class="form-control" name="name_en" value="{{$Grade->name_en}}" required>
                   </div>
               </div>
               <div class="form-group">
                   <label
                       for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                       :</label>
                   <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                             rows="3">{{$Grade->notes}}</textarea>
               </div>
               <br><br>
       </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-secondary"
                   data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
           <button type="submit"
                   class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
       </div>
       </form>

   </div>
</div>
</div>


<!-- delete_modal_Grade -->
<div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('Grades_trans.delete_Grade') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{url("Grades/$Grade->id")}}" method="post">
                   {{method_field('Delete')}}
                   @csrf
                   {{ trans('Grades_trans.Warning_Grade') }}
                   <br><br>
                   <input type="text" name="show_name_of_deleted" class="form-control" value="{{$Grade->name_en}}" disabled>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                       <button type="submit"
                               class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>




                @endforeach


            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ trans('Grades_trans.stage_name_en') }}</th>
                    <th>{{ trans('Grades_trans.stage_name_ar') }}</th>
                    <th>{{ trans('Grades_trans.Notes') }}</th>
                    <th>{{ trans('Grades_trans.Processes') }}</th>

                </tr>
            </tfoot>
            
         </table>
        </div>
        </div>
      </div>   
    </div>

    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{trans('Grades_trans.add_Grade')}}
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- add_form -->
               <form action="{{ route('Grades.store') }}" method="POST">
                   @csrf
                   <div class="row">
                       <div class="col">
                           <label for="name_ar"
                                  class="mr-sm-2">{{trans('Grades_trans.stage_name_ar')}}
                               :</label>
                           <input id="name_ar" type="text" name="name_ar" class="form-control">
                       </div>
                       <div class="col">
                           <label for="name_en"
                                  class="mr-sm-2">{{trans('Grades_trans.stage_name_en')}}
                               :</label>
                           <input type="text" class="form-control" name="name_en" required>
                       </div>
                   </div>
                   <div class="form-group">
                       <label
                           for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                           :</label>
                       <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                 rows="3"></textarea>
                   </div>
                   <br><br>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
                       data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
               <button type="submit"
                       class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
           </div>
           </form>

       </div>
   </div>
</div>
</div> 
<!-- row closed -->
@endsection
@section('js')

@endsection
