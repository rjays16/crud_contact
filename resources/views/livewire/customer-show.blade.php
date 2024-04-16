<div>

    @include('livewire.customermodal')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="card">
                    <div class="card-header">
                        <center><h4>Laravel Crud using B/ootstrap Modal</h4></center>
                        <hr>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#customerModal">
                                Add New Customer
                            </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->password }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateCustomerModal" wire:click="editCustomer({{$customer->id}})" class="btn btn-primary">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal" wire:click="deleteCustomer({{$customer->id}})" class="btn btn-danger">
                                                Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
