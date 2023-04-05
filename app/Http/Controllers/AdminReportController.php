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
        // dd($reportedIdeas);
        return view('admin.reports.ideas.index', compact('reportedIdeas'));
    }
    
    public function reportedComments()
    {
        $reportedComments = CommentReport::paginate(5);

        return view('admin.reports.comments.index', compact( 'reportedComments'));
    }

    public function destroyIdea(IdeaReport $ideaReport)
    {
        // Soft deletes
        $idea = $ideaReport->idea;
        $idea->delete();
        $ideaReport->delete();
        
        Alert::toast('Idea removed successfully', 'success');
        return redirect()->route('admin.reports.ideas');
    }

    public function destroyComment(CommentReport $commentReport)
    {
        $comment = $commentReport->comment;
        $comment->delete();
        $commentReport->delete();

        Alert::toast('Comment removed successfully', 'success');
        return redirect()->route('admin.reports.comments');
    }
}
