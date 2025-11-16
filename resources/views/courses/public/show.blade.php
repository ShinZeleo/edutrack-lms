@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $course->name }}</h1>
            
            <div class="flex flex-wrap justify-between items-center mb-6">
                <div>
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $course->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
                
                <div class="mt-2 md:mt-0">
                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $course->start_date->format('M d, Y') }} - {{ $course->end_date->format('M d, Y') }}
                    </span>
                </div>
            </div>
            
            <div class="mb-6">
                <p class="text-gray-700">
                    <span class="font-semibold">Instructor:</span> {{ $course->teacher->name ?? 'N/A' }}
                </p>
            </div>
            
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-3">Description</h2>
                <p class="text-gray-600">{{ $course->description }}</p>
            </div>
            
            <div class="flex justify-end">
                @auth
                    @if(auth()->user()->isStudent())
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            Enroll in Course
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                        Login to Enroll
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection