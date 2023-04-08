<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Idea;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDeletedUserController extends Controller
{
    /** show a list of deleted accounts */
    public function index()
    {
        $users = User::onlyTrashed()->paginate(5); 
        if($users->isEmpty()) 
        {
            Alert::toast('There are no deleted accounts yet!', 'error');
            return redirect()->route('admin.users.index');
        }

        return view('admin.users.deleted.index', compact('users'));
    }

    /** reactivate the user account */
    public function reactivate($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $deletedIdeas = $user->ideas()->onlyTrashed()->get();
        $deletedComments = $user->comments()->onlyTrashed()->get();

        $user->restore();

        foreach($deletedIdeas as $idea)
        {
            $idea->restore();
        }
        foreach($deletedComments as $comment)
        {
            $comment->restore();
        }

        Alert::toast('User account recovered successfully!', 'success');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        // $user->forceDelete();

        Alert::toast('User account removed!', 'warning');
        return redirect()->route('admin.users.index');
    }
}
