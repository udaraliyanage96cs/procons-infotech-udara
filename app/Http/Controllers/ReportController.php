<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Report;
use Auth;

class ReportController extends Controller
{
    public function reports_add(Request $req){

        if(Report::where('plant_name',$req->name)->where('user_id',Auth::User()->id)->exists()){
            return back()->withErrors(['message' => 'exsists']);
        }

        $filename = "defimage.png";
        if ($req->hasFile('file')) {
            $file = $req->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/reports', $filename);
        }

        $req->validate([
            'name' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lang' => 'required|numeric',
            'desc' => 'nullable|string',
        ]);

        $report = new Report;
        $report->plant_name = $req->name;
        $report->latitude = $req->lat;
        $report->longitude = $req->lang;
        $report->description = $req->desc;
        $report->photo = $filename;
        $report->user_id = Auth::User()->id;
        $report->save();

        return back()->withErrors(['message' => 'success']);
    }

    public function reports_delete(Request $req){
        $report = Report::find($req->id);
        if (!$report) {
            return back()->withErrors(['message' => 'not_found']);
        }
        $report->delete();
        return back()->withErrors(['message' => 'deleted']);
    }

    public function reports_edit(Request $req){

        $report = Report::find($req->id);

        if (!$report) {
            return back()->withErrors(['message' => 'not_found']);
        }

        if ($req->hasFile('file')) {

            if($report->photo != "defimage.png"){
                $file = 'reports/'.$report->photo;
                Storage::disk('public')->delete($file);
            }

            $file = $req->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/reports', $filename);
            $report->update([
                'photo' => $filename,
            ]);
        }

        $report->update([
            'plant_name' => $req->name,
            'latitude' => $req->lat,
            'longitude' => $req->lang,
            'description' => $req->desc,
        ]);
        return back()->withErrors(['message' => 'updated']);
    }

    public function reports_approve(Request $req){
        $report = Report::find($req->id);
        if (!$report) {
            return back()->withErrors(['message' => 'not_found']);
        }
        if($report->status == 0){
            $report->update([
                'status' => 1,
            ]);
        }else{
            $report->update([
                'status' => 0,
            ]);
        }
        
        return back()->withErrors(['message' => 'approved']);
    }

    public function reports_filter(Request $req){

        $req->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|integer',
        ]);
    
        $latitude = $req->latitude;
        $longitude = $req->longitude;
        $radius = $req->radius;
    
        $reports = Report::selectRaw("reports.*, users.name , ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance", [$latitude, $longitude, $latitude])
        ->join('users', 'reports.user_id', '=', 'users.id')
        ->having('distance', '<=', $radius)
        ->get();
    
        return response()->json(['reports' => $reports]);
    }
        
    

    
}