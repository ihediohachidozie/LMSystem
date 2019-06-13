<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use App\Department;
use App\Category;
use App\PublicHoliday;
use DB;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth')->except(['index']); // locking part of a controller
        $this->middleware('auth'); // locking all parts
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::orderBy('id', 'desc')->paginate(5);

        $leaveTypes = $this->leaveType();

        $users = User::all();

        $publicholidays = PublicHoliday::all()->pluck('date');
        
        return view('leave.index', compact('leaves','leaveTypes','users', 'publicholidays'));
    }

    // leave type array method
    private function leaveType()
    {
        return array('Annual','Causal','Examination','Sick','Paternity','Maternity');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $u = User::find(auth()->user()->id)->category;
        
        $users = DB::table('users')
                ->whereNotIn('id', [auth()->id(), 1])
                ->get();
        
        $approvals = DB::table('users')
                     ->where('permission', '=', 'on')
                    ->get();
 
        $leaveTypes = $this->leaveType();
        $leave = new Leave();

        
        if($u == null)
        {
            return back()->withStatus(_('You have not been activated'));
        }
        else{
            return view('leave.create', compact('users', 'leaveTypes', 'leave', 'approvals')); 
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->checkLeavestatus($request->user_id))
        {
            if($this->sameDate($request->user_id, $request->start_date))
            {
                if($this->outstandingDays($request->user_id, $request->year, $request->days))
                {
                    
                    $saveLeave = Leave::create($this->validatedData());
                    
                    return redirect('leave')->withStatus(__('Leave Application successfully saved.'));
                }
                else{
                    return back()->withStatus(__('You have exceed approved days!'));
                }
            }
            else {
                return back()->withStatus(__('Leave entry already exist!'));
            }
        }
        else{
            return redirect('leave')->withStatus(__('You have either a pending or rejected Leave Application.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        $leaveTypes = $this->leaveType();
        $users = User::all();
        return view('leave.show', compact('leave', 'leaveTypes', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        $leaveTypes = $this->leaveType();
        
        $users = DB::table('users')
                ->whereNotIn('id', [auth()->id(), 1])
                ->get();
  
        $approvals = DB::table('users')
                     ->where('permission', '=', 'on')
                    ->get();

        return view('leave.edit', compact('leave', 'leaveTypes', 'users', 'approvals'));
    }
    // leave approval method
    public function approveleave(Request $request, $leave)
    {
        $data = request()->validate([
            'status' => 'sometimes',
        ]);

        $leave = Leave::findorfail($request->leave);
        $leave->update($data);

        return redirect('leave.approval')->withStatus(__('Action completed.'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        if($request->start_date == $request->oldstartdate)
        {
            if($this->outstandingDays4Update($request->user_id, $request->year, $request->days, $request->olddays))
            {
                $leave->update($this->validatedData());
    
                return redirect('leave')->withStatus(__('Leave Application successfully updated.'));
            }
            else{
                return back()->withStatus(__('You have exceed approved days!'));
            }
        }
        else{
            if($this->sameDate($request->user_id, $request->start_date))
            {
                if($this->outstandingDays4Update($request->user_id, $request->year, $request->days, $request->olddays))
                {
                    $leave->update($this->validatedData());
        
                    return redirect('leave')->withStatus(__('Leave Application successfully updated.'));
                }
                else{
                    return back()->withStatus(__('You have exceed approved days!'));
                }
            }
            else {
                return back()->withStatus(__('Leave entry already exist!'));
            }
        }

  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

    // data validation method..
    private function validatedData()
    {
       return request()->validate([
            'start_date' => 'required',
            'days' => 'required|max:30|min:1',
            'year' => 'required|numeric|min:2006|max:2050',
            'leave_type' => 'required',
            'duty_reliever' => 'required',
            'approval_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);
    }

    //return 'Approval page';
    public function approval()
    {
        
        $leaves = Leave::orderBy('id', 'desc')->paginate(5);
        $leaveTypes = $this->leaveType();
        $users = User::all();
      // $userid = Auth::user()->id;
        return view('leave.approval', compact('leaves','leaveTypes','users')); 
    }

    // Check if user id has applied for the same start date ....
    private function sameDate($userid, $startdate)
    {
        $result = Leave::where(['user_id' => $userid, 'start_date' => $startdate])->count();
        return $result == 0 ? true : false ;
    }

    // Outstanding leave days for a particular year...
    private function outstandingDays($userid, $year, $curdays)
    {

        $days_utilized = Leave::where(['user_id' => $userid, 'year' => $year])->groupBy('year')->sum('days');

        $approved_days = User::find($userid)->category->days;

        return $result = $approved_days >= ($days_utilized + $curdays) ? true : false;
    }

    // Outstanding leave days for update method
    private function outstandingDays4Update($userid, $year, $curdays, $oldday)
    {

        $days_utilized = Leave::where(['user_id' => $userid, 'year' => $year])->groupBy('year')->sum('days');

        $approved_days = User::find($userid)->category->days;

        return $result = $approved_days >= ($days_utilized + $curdays - $oldday) ? true : false;
    }

    //leave summary method
    public function leaveSummary()
    {
        if(User::find(auth()->id())->category != null)
        {
            $days = User::findOrfail(auth()->user()->id)->category->days;
            $leaveSummaries = DB::table('leaves')
            ->select('year', DB::raw('sum(days) as days'))
            ->where(['user_id'=> auth()->user()->id, 'status' => 2])
            ->groupBy('year')
            ->pluck('days', 'year');
     
             return view('leave.leaveSummary', compact('leaveSummaries', 'days'));
        }else
        {
            return back()->withStatus(__('No category assigned!'));
        }

    }

    // Check for existing leave that is pending or rejected..
    private function checkLeavestatus($userid)
    {
        //$result = Leave::where(['user_id' => $staffid, 'status' => 0])->orwhere('status', 1)->count();
        $result = DB::table('leaves')->where([
            ['user_id', '=', $userid],
            ['status', '<>', '2']
        ])->count();

        return $result == 0 ? true : false ;
    }

    public function staffleaveentry()
    {
        $leaves = Leave::where('status', '2')->orderBy('id', 'desc')->paginate(5);

        $leaveTypes = $this->leaveType();

        $users = User::all();

        $publicholidays = PublicHoliday::all()->pluck('date');

        //return $publicholidays->count();

        return view('leave.staffleave', compact('leaves','leaveTypes','users', 'publicholidays'));
    }

    public function staffhistory($id)
    {
        $user = User::find($id);

        $users = User::all();

        $leaveTypes = $this->leaveType();

        $publicholidays = PublicHoliday::all()->pluck('date');

        $leaves = DB::table('leaves')->where('user_id', $id)->orderBy('year', 'DESC')->paginate(10);
        
        return view('leave.userhistory', compact('leaves', 'user', 'users', 'publicholidays', 'leaveTypes'));
 
    }

    public function staffsummary($id)
    {
        $user = User::find($id);

        //$days = User::findOrfail(auth()->user()->id)->category->days;

        $staffleave = $this->leavegroupedbyyear($id);
  
        return view('leave.usersummary', compact('user', 'staffleave'));

    }

    private function leavegroupedbyyear($id)
    {
        // grouping the leave entries by year
        $lsum = DB::table('leaves')
        ->select('year', DB::raw('sum(days) as days'))
        ->where('user_id', $id)
        ->groupBy('year')
        ->pluck('days', 'year');

        return $lsum;
    }

    public function getUser()
    {
      //  return 'Hello world';
        $users = User::paginate(10);
        return view('leave.user', compact('users'));
    }

}
