@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Create Category</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="is_active" class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">Active</span>
                    </label>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection