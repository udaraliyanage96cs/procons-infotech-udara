<?php

namespace App\View\Components\Dashboard\Home;

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
            $reports = Report::all();
        }else{
            $reports = Report::where('user_id',Auth::User()->id)->get();
        }

        return view('components.dashboard.home.index')->with("reports",$reports);
    }
}
