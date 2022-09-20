<?php 
namespace App\Http\Controllers\Classroom;

use App\Models\Grade;
use App\Models\Classroom;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Validation\Validator;

class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  { 
 


    $Grades=Grade::all();
    $My_classes=Classroom::with(['grade'])->get();
    return view('pages.Classrooms.Classrooms' , compact('My_classes' , 'Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
    // dd($request->List_Classes);
    // foreach ($request->List_Classes as $key => $value) {
    // }

    $request->validate([
      'List_Classes.*.name_ar' => 'required|unique:classrooms|max:255',
      'List_Classes.*.name_en' => 'required|unique:classrooms|max:255',
      'List_Classes.*.Grade_id' => 'required|exists:grades,id',
    ]);



  try {
    $List_Classes=$request->List_Classes;
   

    foreach ($List_Classes as $key => $value) {
        
 


      $Classroom=Classroom::create([
        'name_ar'=>$value['name_ar'],
        'name_en'=>$value['name_en'],
        'grade_id'=>$value['Grade_id'],
      ]);
    }
    return redirect()->back()->with(['success'=>trans('messages.success')]);

  } 

  catch ( Exception $e) {
    return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
  }


  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request ,  $id)
  {

    $request->validate([
      'name_ar' => 'required|max:255|unique:classrooms,name_ar,'.$id,
      // bas howa law m3rfsh el id momken t3ml fasla kman w t3ml concatintate w t3ml 
      // dawar 3la laravel unique 
      'name_en' => 'required|max:255|unique:classrooms,name_en,'.$id,
      'grade_id' => 'required|exists:grades,id',
    ]);

    $Classroom = Classroom::find($id);
    $Classroom->name_ar=$request->name_ar;
    $Classroom->name_en=$request->name_en;
    $Classroom->grade_id=$request->grade_id;
    $Classroom->save();

    return redirect()->route('Classrooms.index')->with('success' , 'تم تعديل الصف بنجاح');
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
    
    Classroom::FindOrFail($id)->delete();
    

    return redirect()->route('Classrooms.index')->with('success',trans('messages.Delete'));

  }
  
}

?>