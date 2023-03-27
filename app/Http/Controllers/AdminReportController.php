<?php

namespace App\Http\Controllers;

use App\Models\IdeaReport;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminReportController extends Controller
{
    public function index()
    {
        $reportedIdeas = IdeaReport::paginate(5);
        return view('admin.reports.index', compact('reportedIdeas'));
    }

    public function destroy(IdeaReport $ideaReport)
    {
        $ideaReport->delete();
        
        Alert::toast('Report removed', 'success');
        return redirect()->route('admin.reports');
    }
}
