<div>
    @section('title', $article && $article->exists ? 'Edit Article' : 'New Article')

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Article Details</h3>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <span class="mr-3 text-sm font-medium text-gray-700">Status</span>
                        <select wire:model="status" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Save Article
                    </button>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-1">
                        <input type="text" wire:model.live="title" id="title" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g., 5 Tips for Thrifting Vintage Denim">
                    </div>
                    @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            /blog/
                        </span>
                        <input type="text" wire:model="slug" id="slug" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary-500 focus:border-primary-500 sm:text-sm border-gray-300" placeholder="5-tips-for-thrifting">
                    </div>
                    @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700">
                        Excerpt <span class="text-gray-400 font-normal">(Optional)</span>
                    </label>
                    <div class="mt-1">
                        <textarea id="excerpt" wire:model="excerpt" rows="2" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="A brief summary of the article for the blog listing page..."></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Keep it short and engaging.</p>
                </div>

                <!-- Content with Trix Editor -->
                <div wire:ignore>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <input id="x-content" type="hidden" name="content" value="{{ $content }}">
                    <trix-editor input="x-content" class="trix-content min-h-[400px] border-gray-300 rounded-md shadow-sm"></trix-editor>
                </div>
                @error('content') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('trix-change', function(e) {
        @this.set('content', e.target.value);
    });
    
    // Initialize content
    document.addEventListener('livewire:initialized', () => {
        const editor = document.querySelector('trix-editor');
        if (editor && @this.get('content')) {
            editor.editor.loadHTML(@this.get('content'));
        }
    });
</script>
@endpush
