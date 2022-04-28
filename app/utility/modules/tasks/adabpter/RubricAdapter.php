<?php

namespace App\utility\modules\tasks\adabpter;

use App\Models\Rubric;
use App\Models\Sessionable;
use App\Models\Term;
use App\utility\modules\tasks\contract\TaskInterface;
use App\utility\workout\WorkoutService;
use Illuminate\Support\Facades\Auth;

class RubricAdapter implements TaskInterface
{
    protected $view = 'contents.learn.rubric.show';
    public $is_mentor = false;


    public function Render(Term $term, Sessionable $sessionable)
    {
        $user = Auth::user();
        
        $workout = WorkoutService::WorkOutSyncForThisExcersice($term,  $sessionable, $user);
        
        $activity = $sessionable->Model;

        return view($this->view, compact([
            'activity', 'workout'
        ]));
    }

    public function Review()
    {
        return $this->is_mentor;
    }

    public function Mentor()
    {
        $this->is_mentor = true;
    }
}