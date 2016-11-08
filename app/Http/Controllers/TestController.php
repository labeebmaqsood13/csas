<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Test;
use Input;
use Schema;
use Redirect;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $test = Test::select()
            ->orderBy('id')
            ->get()
            ;
        
        // $test_columns = Schema::getColumnListing('tests');
        $test_model = new Test();
        $fillable_columns = $test_model->getFillable();
        foreach ($fillable_columns as $key => $value) {
            $test_columns[$value] = $value;
        }
        
        return view('test.index')
            ->with('test', $test)
            ->with('test_columns', $test_columns)
        ;
    }
    public function update(Request $request, $id)
    {
        $test = Test::find($id);
        // $column_name = Input::get('name');
        // $column_value = Input::get('value');

        $column_name = $request->input('name');
        $column_value = $request->input('value');
        
        
        if( $request->has('name') && $request->has('value')) {
            $test = Test::select()
                ->where('id', '=', $id)
                ->update([$column_name => $column_value]);
            return response()->json([ 'code'=>200], 200);
        }
        
        return response()->json([ 'error'=> 400, 'message'=> 'Not enought params' ], 400);
    }


    
    public function bulk_update(Request $request)
    {
        if ($request->has('ids_to_edit') && $request->has('bulk_name') && $request->has('bulk_value')) {
            // $ids = Input::get('ids_to_edit');
            $ids = $request->input('ids_to_edit');
            // $bulk_name = Input::get('bulk_name');
            $bulk_name = $request->input('bulk_name');
            // $bulk_value = Input::get('bulk_value');
            $bulk_value = $request->input('bulk_value');
            foreach ($ids as $id) {
                $test = Test::select()
                    ->where('id', '=', $id)
                    ->update([$bulk_name => $bulk_value]);
            }
            // return Redirect::route('client/leads')->with('message', $message);
            $message = "Done";
        } else {
            $message = "Error. Empty or Wrong data provided.";
            return Redirect::back()->withErrors(array('message' => $message))->withInput();
        }
        return Redirect::back()->with('message', $message);
    }
    
}
