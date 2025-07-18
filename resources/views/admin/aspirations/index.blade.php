<x-admin-layout header="Daftar Aspirasi">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Nama</th>
                                    <th class="py-3 px-6 text-left">Email</th>
                                    <th class="py-3 px-6 text-left">Subjek</th>
                                    <th class="py-3 px-6 text-left">Tanggal</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                    <th class="py-3 px-6 text-center">Visibilitas</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @forelse ($aspirations as $aspiration)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-3 px-6 text-left">{{ $aspiration->name }}</td>
                                        <td class="py-3 px-6 text-left">{{ $aspiration->email }}</td>
                                        <td class="py-3 px-6 text-left">{{ Str::limit($aspiration->subject, 30) }}</td>
                                        <td class="py-3 px-6 text-left">{{ $aspiration->created_at->format('d M Y') }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $aspiration->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $aspiration->status === 'read' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $aspiration->status === 'responded' ? 'bg-green-100 text-green-800' : '' }}
                                            ">
                                                {{ ucfirst($aspiration->status) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <form action="{{ route('admin.aspirations.toggle-visibility', $aspiration) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-2 py-1 text-xs rounded-full 
                                                    {{ $aspiration->is_visible ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}
                                                    hover:bg-opacity-80 transition-colors duration-200"
                                                >
                                                    {{ $aspiration->is_visible ? 'Publik' : 'Privat' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <a href="{{ route('admin.aspirations.show', $aspiration) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.aspirations.destroy', $aspiration) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-3 px-6 text-center">Tidak ada data aspirasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $aspirations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>