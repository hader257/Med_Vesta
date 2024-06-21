<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use App\Models\Comment ;
use Auth ;
class DoctorComments extends Component
{
    public $doc_id;
    public $comments;
    public $newComment ;

    public function mount($doc_id)
    {
        $this->doc_id = $doc_id ;
        $this->loadComments();
        // $this->store() ;
    }
    public function loadComments()
    {
        $this->comments = Comment::where('doctor_id' , $this->doc_id)->get();
    }
    public function store()
    {
        $this->validate([
            'newComment' => 'required|string|min:10',
        ]);
        Comment::create([
            'comment' => $this->newComment ,
            'patient_id' => auth()->user()->id,
            'doctor_id' => $this->doc_id
        ]);
        $this->loadComments();
        $this->reset(['newComment']);
        // Event::dispatch('commentAdded');
    }

    public function delete($comment_id)
    {
        $comment = Comment::find($comment_id) ;
        $comment->delete() ;
        session()->flash('delete' , 'Delete of comment') ;
    }

    public function render()
    {
        return view('livewire.doctor-comments' , ['comments' => $this->loadComments()]);
    }
}
