<?php
  
namespace App\Http\Controllers;
   
use App\Models\Property;
use App\Models\Realtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
  
class RealtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortBy = $request->query('sortBy','realtors.phone');
        $order = $request->query('order','asc');  
        $realtors = Realtor::join('users','users.id','=','realtors.user_id')
        ->select('realtors.id','phone','user_id','users.name as user_name','users.email as user_email')
        ->orderBy($sortBy,$order)->paginate(5);

        $existRealtorProfile = (Realtor::all()->where('user_id', Auth::user()->id)->count() != 0);
        return view('realtors.index',compact('realtors','sortBy','order','existRealtorProfile'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        return view('realtors.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
        
        $user_id = Auth::id();
        
        $realtor = Realtor::create($request->all());
        $realtor->user_id = $user_id;
        $realtor->save();

      
        return redirect()->route('realtors.index')
                        ->with('success','Realtor created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Realtor  $realtor
     * @return \Illuminate\Http\Response
     */
    public function show(Realtor $realtor)
    {
        return view('realtors.show',compact('realtor'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Realtor  $realtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Realtor $realtor)
    {
        return view('realtors.edit',compact('realtor'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Realtor  $realtor
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Realtor $realtor)
    {
        $request->validate([
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $realtor->update($request->all());

        return redirect()->route('realtors.index')
                        ->with('success','Realtor updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Realtor  $realtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Realtor $realtor)
    {
        $realtor->delete();
    
        return redirect()->route('realtors.index')
                        ->with('success','Realtor deleted successfully');
    }
}
