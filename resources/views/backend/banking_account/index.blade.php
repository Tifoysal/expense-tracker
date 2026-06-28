@extends('backend.layouts.app')
@section('content')
<section class="content">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex justify-between items-center pt-5 px-5">
                        <h6 class="text-xl font-semibold text-gray-800">All Account Lists</h6>
                        
                        <div class="flex bg-gray-100 p-1 rounded-lg">
                            <button id="show-grid" class="px-3 py-1 rounded-md bg-white shadow-sm text-gray-700 transition">
                                <i class="fa fa-th-large"></i>
                            </button>
                            <button id="show-list" class="px-3 py-1 rounded-md text-gray-500 hover:text-gray-700 transition">
                                <i class="fa fa-list"></i>
                            </button>
                        </div>
                    </div>

                    <div class="px-6 py-4 border-b flex justify-between items-center">
                        <a href="{{ route('banking.account.create') }}"
                            class="bg-green-500 text-white text-sm font-bold uppercase px-6 py-2 rounded hover:bg-green-600 transition duration-200">
                            <i class="fa fa-plus mr-2"></i> Add New Account
                        </a>
                    </div>

                    <div class="px-6 py-4">
                        @if (session('success'))
                        <div class="relative p-4 mb-4 text-white bg-gradient-to-r from-green-500 to-lime-400 rounded-lg shadow">
                            {{ session('success') }}
                            <button type="button" class="absolute top-2 right-2 text-xl font-bold leading-none focus:outline-none" onclick="this.parentElement.remove()">
                                ×
                            </button>
                        </div>
                        @endif

                        <div id="account-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-4">
                            @foreach($accounts as $account)
                            <div class="{{ $account->default_account ? 'bg-green-50 border-green-600' : 'bg-white' }} border rounded-2xl shadow-sm p-5 hover:shadow-md transition relative group">
                                
                                <div class="absolute top-3 right-3 flex items-center space-x-3">
                                    <a href="{{ route('banking.account.edit', $account->id) }}" class="text-gray-400 hover:text-blue-600 transition-colors" title="Edit Account">
                                        <i class="fa fa-edit text-lg"></i>
                                    </a>

                                    <label class="inline-flex items-center cursor-pointer group" title="{{ $account->status === 'frozen' ? 'Frozen' : 'Active' }}">
                                        <input type="checkbox" class="sr-only peer toggle-account" data-account-id="{{ $account->id }}" {{ $account->status === 'active' ? 'checked' : '' }}>
                                        <div class="w-10 h-5 bg-gray-300 rounded-full peer peer-checked:bg-green-500 transition-all duration-300 after:content-[''] after:absolute after:top-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5"></div>
                                    </label>
                                </div>

                                <div class="flex items-center space-x-4 mt-2">
                                    <div class="{{ $account->type === 'bank' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }} p-3 rounded-full">
                                        @if($account->type === 'credit-card')
                                            <i class="fa fa-credit-card text-xl"></i>
                                        @else
                                            <i class="fa fa-university text-xl"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">{{ ucfirst($account->type) }}</p>
                                        <p class="text-lg font-semibold text-gray-800">{{ $account->name }}</p>
                                        @if($account->account_no)
                                            <p class="text-xs text-gray-400">A/C: {{ $account->account_no }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4 text-right">
                                    <p class="text-sm text-gray-500">Balance</p>
                                    <p class="text-xl font-bold text-gray-800">
                                        {{ $account->currency ?? 'BDT' }} {{ number_format($account->balance, 2) }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div id="account-list" class="hidden overflow-x-auto border rounded-lg mt-4">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($accounts as $account)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $account->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($account->type) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $account->account_no ?? '---' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">{{ $account->currency ?? 'BDT' }} {{ number_format($account->balance, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $account->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ ucfirst($account->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('banking.account.edit', $account->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const gridBtn = document.getElementById('show-grid');
    const listBtn = document.getElementById('show-list');
    const gridView = document.getElementById('account-grid');
    const listView = document.getElementById('account-list');

    // View Switching Logic
    gridBtn.addEventListener('click', function() {
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        // Update button styles
        gridBtn.classList.add('bg-white', 'shadow-sm');
        listBtn.classList.remove('bg-white', 'shadow-sm');
    });

    listBtn.addEventListener('click', function() {
        listView.classList.remove('hidden');
        gridView.classList.add('hidden');
        // Update button styles
        listBtn.classList.add('bg-white', 'shadow-sm');
        gridBtn.classList.remove('bg-white', 'shadow-sm');
    });

    // Existing Status Switch Logic
    const toggles = document.querySelectorAll('.toggle-account');
    toggles.forEach(toggle => {
      toggle.addEventListener('change', function () {
        const accountId = this.dataset.accountId;

        fetch(`/banking-account/status-switch/${accountId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Option: refresh page or update UI manually
            window.location.reload(); 
          } else {
            alert('Failed to update account status.');
            this.checked = !this.checked; // Revert checkbox if failed
          }
        })
        .catch(err => {
          alert('Error occurred: ' + err);
          this.checked = !this.checked;
        });
      });
    });
  });
</script>
@endsection