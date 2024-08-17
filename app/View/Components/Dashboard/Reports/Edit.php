<?php

namespace App\View\Components\Dashboard\Reports;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Report;
use Auth;

class Edit extends Component
{
    public $reportID;
    /**
     * Create a new component instance.
     */
    public function __construct($reportID)
    {
        $this->reportID = $reportID;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $report = Report::findorfail($this->reportID);
        if($report->user_id == Auth::User()->id){
            return view('components.dashboard.reports.edit')->with("report",$report);
        }else{
            return view('errors.noaccess');
        }
    }
}
