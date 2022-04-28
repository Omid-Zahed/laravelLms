<?php

namespace App\utility\modules\tasks\adabpter;

use App\Models\Sessionable;
use App\Models\Term;
use App\utility\file\FileFactory;
use App\utility\modules\tasks\contract\TaskInterface;
use App\utility\workout\WorkoutService;
use Illuminate\Support\Facades\Auth;

class FileAdapter implements TaskInterface
{
    protected $view = 'contents.learn.document.file';
    public $is_mentor = false;


    public function Render(Term $term, Sessionable $sessionable)
    {
        $user = Auth::user();
        
        $workout = WorkoutService::WorkOutSyncForThisExcersice($term, $sessionable, $user);
        
        $activity = $sessionable->Model;
        $file = FileFactory::Build($activity)->makeRenderFile();

        return view($this->view, compact([
            'activity', 'workout', 'term', 'file'
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