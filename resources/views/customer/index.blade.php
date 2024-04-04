@extends('layouts.app')

@section('content')

    <div>
        <livewire:customer-show>
    </div>

@endsection

@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#customerModal').modal('hide');
        $('#updateCustomerModal').modal('hide');
        $('#deleteCustomerModal').modal('hide');
    })
</script>
@endsection