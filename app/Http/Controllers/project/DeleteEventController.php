<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class DeleteEventController extends Controller
{
    public function delete($event_id) {

        $event = Event::find($event_id);
        $event->status = 0;
        

        if($event->save()) {
            return redirect()->route('deleteEvent');
        }
    }
}