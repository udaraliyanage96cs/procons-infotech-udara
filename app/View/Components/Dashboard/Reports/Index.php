<?php

namespace App\View\Components\Dashboard\Reports;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Report;
use Auth;

class Index extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if(Auth::User()->role == "admin"){
            $reports = Report::join('users','users.id','=','reports.user_id')->get(['reports.*','users.name']);
        }else{
            $reports = Report::join('users','users.id','=','reports.user_id')->where('user_id',Auth::User()->id)->get(['reports.*','users.name']);
        }
        return view('components.dashboard.reports.index')->with('reports',$reports);
    }
}
