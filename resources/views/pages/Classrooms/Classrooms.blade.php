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
            <h4 class="mb-0">{{ trans('main_trans.classes') }}</h4>
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
                {{ trans('My_classes_trans.add_class') }}
            </button>

            <button type="button" class="button x-small" id="btn_delete_all">
                {{ trans('My_Classes_trans.delete_checkbox') }}
            </button>

            <br><br>
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)"/></th>
                    <th>#</th>
                    <th>{{ trans('My_classes_trans.Name_class_en')}}</th>
                    <th>{{ trans('My_classes_trans.Name_class_ar')}}</th>
                    <th>{{ trans('My_classes_trans.Name_Grade')}}</th>
                    <th>{{ trans('My_classes_trans.Processes') }}</th>
               
                </tr>
            </thead>
            <tbody id='hamoksha'>
                {{-- <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                </tr>    --}}
                @foreach ( $My_classes as $key => $My_class )
                
                <tr>
                    <td><input type="checkbox" name= "id[]" class="box1" class="checkbox" value="{{ $My_class->id }}"></td>
                    <td>{{$key+1}}</td>
                    <td>{{$My_class['name_en']}}</td>
                    <td>{{$My_class['name_ar']}}</td>
                    <td>{{$My_class->grade->name_en}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" title="{{trans('My_Classes_trans.Edit')}}" data-toggle="modal" data-target="#edit{{$My_class->id}}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" title="{{trans('My_Classes_trans.Delete')}}" data-toggle="modal" data-target="#delete{{$My_class->id}}">
                            <i class="fa fa-trash"></i>
                        </button>

                    </td>
                  
                </tr>  

<!-- Edit_modal_Class -->
<div class="modal fade" id="edit{{$My_class->id}}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
               id="exampleModalLabel">
               {{trans('My_Classes_trans.Edit')}}
           </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>


       <div class="modal-body">
           <!-- add_form -->
           <form action="{{url("Classrooms/$My_class->id")}}" method="POST">
                @method('PUT')
               @csrf
               <div class="row">
                   <div class="col">
                       <label for="name_ar"
                              class="mr-sm-2">{{trans('My_Classes_trans.Name_class_ar')}}
                           :</label>
                       <input id="name_ar" type="text" name="name_ar" class="form-control" value="{{$My_class->name_ar}}">
                   </div>
                   <div class="col">
                       <label for="name_en"
                              class="mr-sm-2">{{trans('My_Classes_trans.Name_class_en')}}
                           :</label>
                       <input type="text" class="form-control" name="name_en" value="{{$My_class->name_en}}" required>
                   </div>
                   <div class="col">
                   
                    <label for="exampleFormControlTextarea1"> {{trans('My_Classes_trans.Name_Grade')}}:</label>
                    <select class="form-control form-control-lg" id="exampleFormControlTextarea1" name="grade_id">
                        @foreach ($Grades as $Grade)
                        <option value="{{$Grade->id}}" @if ($Grade->id == $My_class->grade->id) selected @endif>{{$Grade->name_en}} </option>    
                        @endforeach
                    </select> 
                    </div>
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
<div class="modal fade" id="delete{{ $My_class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('My_classes_trans.delete_class') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{url("Classrooms/$My_class->id")}}" method="post">
                   {{method_field('Delete')}}
                   @csrf
                   {{ trans('My_classes_trans.Warning_class') }}
                   <br><br>
                   <input type="text" name="show_name_of_deleted" class="form-control" value="{{$My_class->name_en}}" disabled>
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



<!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('My_Classes_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('delete_all') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    {{ trans('My_Classes_trans.Warning_Grade') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>




                @endforeach


            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ trans('My_classes_trans.Name_class_en') }}</th>
                    <th>{{ trans('My_classes_trans.Name_class_ar') }}</th>
                    <th>{{ trans('My_classes_trans.Name_Grade')}}</th>
                    <th>{{ trans('My_classes_trans.Processes') }}</th>

                </tr>
            </tfoot>
            
         </table>
        </div>
        </div>
      </div>   
    </div>

    <!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ trans('My_Classes_trans.add_class') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form class=" row mb-30" action="{{ route('Classrooms.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="repeater">
                        <div data-repeater-list="List_Classes">
                            <div data-repeater-item>
                                <div class="row">

                                    <div class="col">
                                        <label for="Name"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_ar') }}
                                            :</label>
                                        <input class="form-control" type="text" name="name_ar" />
                                    </div>


                                    <div class="col">
                                        <label for="Name"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                            :</label>
                                        <input class="form-control" type="text" name="name_en" />
                                    </div>


                                    <div class="col">
                                        <label for="Name_en"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                            :</label>

                                        <div class="box">
                                            <select class="fancyselect" name="Grade_id">
                                                @foreach ($Grades as $Grade)
                                                    <option value="{{ $Grade->id }}">{{ $Grade->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col">
                                        <label for="Name_en"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                            :</label>
                                        <input class="btn btn-danger btn-block" data-repeater-delete
                                            type="button" value="{{ trans('My_Classes_trans.delete_row') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-12">
                                <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                            <button type="submit"
                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    
</div> 
<!-- row closed -->
@endsection
@section('js')

{{-- <script> 
console.log($("#datatable input[type=checkbox]:checked"));
</script> --}}

<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            console.log($("#datatable input[type=checkbox]:checked"));
            $("#hamoksha input[type=checkbox]:checked").each(function() {
                    // console.log(this.value);
                    selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show');
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>
@endsection
