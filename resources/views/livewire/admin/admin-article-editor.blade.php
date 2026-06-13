<div>
    @section('title', $article && $article->exists ? 'Edit Article' : 'New Article')

    <form wire:submit="save" class="space-y-6">
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Article Details</h3>
                <div class="flex items-center space-x-3">
                    <button type="button" wire:click="save('draft')" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 shadow-sm" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save('draft')">Save Draft</span>
                        <span wire:loading wire:target="save('draft')">Saving...</span>
                    </button>
                    <button type="button" wire:click="save('published')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save('published')">Publish Article</span>
                        <span wire:loading wire:target="save('published')">Publishing...</span>
                    </button>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-1">
                        <input type="text" wire:model.live="title" id="title" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md px-3 py-2" placeholder="e.g., 5 Tips for Thrifting Vintage Denim">
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
                <!-- Cover Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cover Image</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500 px-1">
                                    <span>Upload a file</span>
                                    <input id="file-upload" wire:model="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                        </div>
                    </div>
                    <div wire:loading wire:target="image" class="mt-2 text-sm text-primary-600">Uploading...</div>
                    @error('image') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

                    <!-- Preview -->
                    @if ($image)
                        <div class="mt-4 relative inline-block">
                            <img src="{{ $image->temporaryUrl() }}" class="h-32 w-auto object-cover rounded-md border border-gray-200">
                            <button type="button" wire:click="removeImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    @elseif ($existingImage)
                        <div class="mt-4 relative inline-block">
                            <img src="{{ asset('storage/' . $existingImage) }}" class="h-32 w-auto object-cover rounded-md border border-gray-200">
                            <button type="button" wire:click="removeExistingImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    @endif
                </div>


                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700">
                        Excerpt <span class="text-gray-400 font-normal">(Optional)</span>
                    </label>
                    <div class="mt-1">
                        <textarea id="excerpt" wire:model="excerpt" rows="2" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md px-3 py-2" placeholder="A brief summary of the article for the blog listing page..."></textarea>
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

    @script
    <script>
        document.addEventListener('trix-change', function(e) {
            $wire.content = e.target.value;
        });
        
        // Initialize content
        const editor = document.querySelector('trix-editor');
        if (editor && $wire.content) {
            editor.editor.loadHTML($wire.content);
        }

        document.addEventListener("trix-attachment-add", function(event) {
            if (event.attachment.file) {
                uploadFileAttachment(event.attachment);
            }
        });

        function uploadFileAttachment(attachment) {
            var file = attachment.file;
            var form = new FormData();
            form.append("file", file);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('admin.upload-image') }}", true);
            xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            xhr.upload.onprogress = function(event) {
                var progress = event.loaded / event.total * 100;
                attachment.setUploadProgress(progress);
            };

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    attachment.setAttributes({
                        url: response.url,
                        href: response.url
                    });
                } else {
                    console.error("Upload failed.");
                }
            };

            xhr.send(form);
        }
    </script>
    @endscript
</div>
