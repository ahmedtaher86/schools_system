<?php 
namespace App\Http\Controllers\Grade;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Termwind\Components\Dd;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades=Grade::all();
    return view('pages.Grades.Grades' , compact('Grades'));
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

    $request->validate([
      'name_ar' => 'required|unique:grades|max:255',
      'name_en' => 'required|unique:grades|max:255',
      'notes' => 'required',
  ]);

   

    $Grade = new Grade();
    $Grade->name_ar=$request->name_ar;
    $Grade->name_en=$request->name_en;
    $Grade->notes=$request->notes;
    $Grade->save();

    return redirect()->route('Grades.index')->with('success' , 'تم اضافة المرحلة بنجاح');
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
  public function update(Request $request ,$id)
  {


    $request->validate([
      'name_ar' => 'required|max:255',
      'name_en' => 'required|max:255',
      'notes' => 'required',
    ]);
    

    $Grade = Grade::find($id);
    $Grade->name_ar=$request->name_ar;
    $Grade->name_en=$request->name_en;
    $Grade->notes=$request->notes;
    $Grade->save();

    return redirect()->route('Grades.index')->with('success' , 'تم تعديل المرحلة بنجاح');


  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

    Grade::FindOrFail($id)->delete();
    

    return redirect()->route('Grades.index')->with('success',trans('messages.Delete'));

  }
  
}

?>