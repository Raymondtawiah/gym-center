<x-layouts::app-main title="Gym Settings - GymCenter">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-white">Gym Settings</h1>
            <p class="text-zinc-400 text-sm mt-1">Configure your gym center details</p>
        </div>

        <!-- Settings Form -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="p-6 sm:p-8">
                <form method="POST" action="{{ route('admin.gym.update', $gym) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-400 mb-2">Gym Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $gym->name) }}"
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('name')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-zinc-400 mb-2">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $gym->slug) }}"
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-400 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $gym->email) }}"
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-zinc-400 mb-2">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $gym->phone) }}"
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-zinc-400 mb-2">Address</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none">{{ old('address', $gym->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-4 border-t border-zinc-800">
                        <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white text-sm font-medium rounded-xl transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app-main>
