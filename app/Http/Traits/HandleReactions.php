<?php 

namespace App\Http\Traits;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait HandleReactions
{
    public function like(Request $request)
    {
        $this->handleReaction($request, 'like');
    }

    public function unlike(Request $request)
    {
        $this->handleReaction($request, 'unlike');
    }

    protected function handleReaction(Request $request, string $reaction)
    {
        $user_id = auth()->id();

        /** reactionable_id is the id for the model like Idea or Comment which the users can react to */
        $reactionable_id = $request->input('id');

        $existing_reaction = DB::table($this->table())
            ->where('user_id', $user_id)
            ->where($this->reactionable_id_name(), $reactionable_id)
            ->first();

        /** if the user has already reacted to the reactionable */
        if($existing_reaction)
        {
            /** delete the record from the intermediate table */
            if($existing_reaction->reaction == $reaction)
            {
                DB::table($this->table())
                    ->where('user_id', $user_id)
                    ->where($this->reactionable_id_name(), $reactionable_id)
                    ->delete();
            }
            /** update the record with the new reaction */
            else 
            {
                DB::table($this->table())
                    ->where('user_id', $user_id)
                    ->where($this->reactionable_id_name(), $reactionable_id)
                    ->update(['reaction' => $reaction, 'updated_at' => now()]);
            }
        }
        /** if the user has not reacted before */
        else
        {
            DB::table($this->table())
                ->insert([
                    'user_id' => $user_id,
                    $this->reactionable_id_name() => $reactionable_id,
                    'reaction' => $reaction,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
    }

    public function table()
    {
        // Override this method in the controller to return the table name of the pivot table
    }

    public function reactionable_id_name()
    {
        // Override this method in the controller to return the id name of the reactionable model class 
    }
}