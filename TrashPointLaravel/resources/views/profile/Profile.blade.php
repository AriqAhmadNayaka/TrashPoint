@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-green-600 px-6 py-4">
            <h2 class="text-2xl font-bold text-white">Edit Profile</h2>
        </div>
        
        <div class="p-6">


                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ auth()->user()->username }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Phone Number -->
                <div class="mb-4">
                    <label for="phoneNumber" class="block text-gray-700 font-bold mb-2">Phone Number</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" value="{{ auth()->user()->phoneNumber }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Password (Optional) -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">New Password (Optional)</label>
                    <input type="password" id="password" name="password" placeholder="Leave blank to keep current password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" onclick="editUser({{Auth::user()->idUser}})" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                        Update Profile
                    </button>
                    
                    <button type="button" id="deleteAccountBtn" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                        Delete Account
                    </button>
                </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function editUser(idUser) {

        const username = document.getElementById('username').value;
        const phoneNumber = document.getElementById('phoneNumber').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        console.log(username, phoneNumber, email, password);
        
        // Prepare data object
        const data = {
            username: username,
            phoneNumber: phoneNumber,
            email: email
        };

        // Only add password if it's not empty
        if (password) {
            data.password = password;
        }

        // Kirim data ke server
        fetch(`/api/users/${idUser}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success || data.status === 'success' || data.idUser) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Profile berhasil diperbarui.',
                    icon: 'success'
                }).then(() => {
                    location.reload();
                });
                
            } else {
                Swal.fire('Gagal!', data.message || 'Terjadi kesalahan saat memperbarui profile.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
        });
    }

    document.getElementById('deleteAccountBtn').addEventListener('click', function() {
        const idUser = "{{ Auth::user()->idUser }}";
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Akun anda akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/api/users/${idUser}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire(
                        'Terhapus!',
                        'Akun anda telah dihapus.',
                        'success'
                    ).then(() => {
                        window.location.href = '/';
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Gagal menghapus akun.', 'error');
                });
            }
        });
    });
</script>
@endpush
                                @endsection