<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-border">
            <h1 class="text-2xl font-bold text-heading">Manage Lessons for "{{ $course->name }}"</h1>
            <p class="text-textSecondary mt-1">Add, edit, or remove lessons</p>
        </div>
        
        <div class="p-6">
            <!-- Add New Lesson -->
            <div class="mb-6">
                <a href="{{ route('teacher.courses.lessons.create', $course) }}" 
                   class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-md">
                    + Add New Lesson
                </a>
            </div>

            <!-- Lessons Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border">
                    <thead class="bg-bgSection">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-textHint uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-textHint uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-textHint uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-textHint uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-border">
                        @forelse($lessons as $lesson)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-heading font-medium">{{ $lesson->order + 1 }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-heading">{{ $lesson->title }}</div>
                                    <div class="text-sm text-textSecondary">{{ Str::limit($lesson->content, 80) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $lesson->order }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('teacher.courses.lessons.edit', [$course, $lesson]) }}" 
                                       class="text-blue-600 hover:text-blue-900 mr-3">
                                        Edit
                                    </a>
                                    <form action="{{ route('teacher.courses.lessons.destroy', [$course, $lesson]) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this lesson?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-textHint">
                                    No lessons created for this course yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>