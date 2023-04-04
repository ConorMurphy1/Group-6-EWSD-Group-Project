<?php

namespace App\Http\Controllers;

use App\Models\CommentReport;
use App\Models\IdeaReport;
use RealRashid\SweetAlert\Facades\Alert;

class AdminReportController extends Controller
{
    public function reportedIdeas()
    {
        $reportedIdeas = IdeaReport::paginate(5);
        
        return view('admin.reports.ideas.index', compact('reportedIdeas'));
    }
    
    public function reportedComments()
    {
        $reportedComments = CommentReport::paginate(5);

        return view('admin.reports.comments.index', compact( 'reportedComments'));
    }

    public function destroy(IdeaReport $ideaReport)
    {
        $ideaReport->delete();
        
        Alert::toast('Report removed', 'success');
        return redirect()->route('admin.reports');
    }

    public function destroyComment(CommentReport $commentReport)
    {
        $commentReport->delete();

        Alert::toast('Comment report removed', 'success');
        return redirect()->route('admin.reports');
    }
}
