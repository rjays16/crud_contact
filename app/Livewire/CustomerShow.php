<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Customer;
use Livewire\Component;

class CustomerShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $email, $phone, $password;
    public $customer_id;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'password' => 'required|string'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveCustomer()
    {
        $validatedData = $this->validate();

        Customer::create($validatedData);
        session()->flash('message','Customer Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function editCustomer(int $customer_id)
    {
        $customer = Customer::find($customer_id);
        if($customer){

            $this->customer_id = $customer->id;
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->phone = $customer->phone;
            $this->password = $customer->password;
        }else{
            return redirect()->to('/customer');
        }
    }

    public function updateCustomer()
    {
        $validatedData = $this->validate();

        Customer::where('id',$this->customer_id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => $validatedData['password']
        ]);
        session()->flash('message','Customer Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteCustomer(int $customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function destroyCustomer()
    {
        Customer::find($this->customer_id)->delete();
        session()->flash('message','Customer Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
    }

    public function render()
    {
        $customers = Customer::orderBy('id','DESC')->paginate(3);
        return view('livewire.customer-show', ['customers' => $customers]);
    }
}
