<?php

namespace App\Http\Livewire\Admin\Offers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\TransactionType;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use WithPagination;

    public $featured = true;
    public $search;
    public $sortField;
    public $sortAsc = true;
    public $categories;
    public $category;
    public $transactions;
    public $transaction_type;

    protected $queryString = ['search', 'featured', 'sortField', 'sortAsc', 'category', 'transaction_type'];

    public function mount()
    {
        $this->categories = Category::all();
        $this->transactions = TransactionType::all();
    }

    public function sortBy($field)
    {
        if($this->sortField == $field){
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.offers.data-tables', [
            'offers' => Offer::latest()->where(function ($query){
                $query->filter(['search' => $this->search]);
            })->where('featured', $this->featured)
                ->when($this->category, function ($query){
                    $query->filter(['category' => $this->category]);
                })->when($this->transaction_type, function ($query){
                    $query->filter(['transaction_type' => $this->transaction_type]);
                })->when($this->sortField, function ($query){
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })->paginate(10),
        ]);
    }
}
