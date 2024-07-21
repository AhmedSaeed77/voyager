<?php

namespace App\Livewire;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithFileUploads;

class Articles extends Component
{
    use WithFileUploads;

    public $articles, $name,$image,$article_id;
    public $updateMode = false;

    public function render()
    {
        $this->articles = Article::latest()->get();
        return view('livewire.articles');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->image = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
                                            'name' => 'required',
                                            'image' => 'required',
                                        ]);
        $article = Article::create($validatedDate);
        if ($this->image)
        {
            $imagePath = $this->image->store('image', 'public');
            $article->update(['image' => $imagePath]);
        }
        session()->flash('message', 'Article Created Successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->article_id = $id;
        $this->name = $article->name;
        $this->image = $article->image;
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
                                            'image' => 'required',
                                        ]);
        $article = Article::find($this->article_id);
        $article->update(['name' => $this->name]);
        if ($this->image)
        {
            $imagePath = $this->image->store('image', 'public');
            $article->update(['image' => $imagePath]);
        }
        $this->updateMode = false;
        session()->flash('message', 'Article Updated Successfully.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Article::find($id)->delete();
        session()->flash('message', 'Article Deleted Successfully.');
    }
}
