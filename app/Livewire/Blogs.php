<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blog;

class Blogs extends Component
{
    public $blogs, $name,$blog_id;
    public $updateMode = false;

    public function render()
    {
        $this->blogs = Blog::latest()->get();
        return view('livewire.blogs');
    }

    private function resetInputFields()
    {
        $this->name = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
                                            'name' => 'required',
                                        ]);
        Blog::create($validatedDate);
        session()->flash('message', 'Blog Created Successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $this->blog_id = $id;
        $this->name = $blog->name;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
                                            'name' => 'required',
                                        ]);
        $blog = Blog::find($this->blog_id);
        $blog->update([
                        'name' => $this->name,
                    ]);
        $this->updateMode = false;
        session()->flash('message', 'Blog Updated Successfully.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Blog::find($id)->delete();
        session()->flash('message', 'Blog Deleted Successfully.');
    }
}
