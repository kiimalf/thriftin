<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Create New Listing</h1>
            <p class="mt-2 text-sm text-gray-500">Add photos and details about your item to help buyers find it.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
    <div>
            @if($previewMode)
                <div class="bg-white shadow sm:rounded-lg overflow-hidden mb-6">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Preview Listing</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Preview Mode
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="md:grid md:grid-cols-2 md:gap-x-8 md:items-start">
                            <div class="flex flex-col-reverse">
                                <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100">
                                    @if($images)
                                        <img src="{{ $images[0]->temporaryUrl() }}" alt="Preview" class="w-full h-full object-center object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-10 px-4 sm:px-0 sm:mt-16 md:mt-0">
                                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $title }}</h1>
                                <div class="mt-3">
                                    <p class="text-3xl text-gray-900 font-bold">Rp {{ number_format((float)($price ?: 0), 0, ',', '.') }}</p>
                                </div>
                                <div class="mt-4">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            Condition: {{ ucwords(str_replace('_', ' ', $condition)) }}
                                        </span>
                                        @if($size)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            Size: {{ $size }}
                                        </span>
                                        @endif
                                        @if($gender)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            Gender: {{ ucfirst($gender) }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <h3 class="sr-only">Description</h3>
                                    <div class="text-base text-gray-700 space-y-6">
                                        {!! nl2br(e($description)) !!}
                                    </div>
                                    @if($brand || $weight)
                                    <div class="mt-8 border-t border-gray-200 pt-8">
                                        <h3 class="text-sm font-medium text-gray-900">Additional Details</h3>
                                        <div class="mt-4 prose prose-sm text-gray-500">
                                            <ul role="list">
                                                @if($brand) <li><strong>Brand:</strong> {{ $brand }}</li> @endif
                                                @if($weight) <li><strong>Weight:</strong> {{ $weight }} grams</li> @endif
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="backToEdit" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Back to Edit
                    </button>
                    <button type="button" wire:click="save('draft')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save('draft')">Save as Draft</span>
                        <span wire:loading wire:target="save('draft')">Saving...</span>
                    </button>
                    <button type="button" wire:click="save('active')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save('active')">Publish Listing</span>
                        <span wire:loading wire:target="save('active')">Publishing...</span>
                    </button>
                </div>
            @else
            <form wire:submit.prevent="preview">
                <div class="shadow sm:rounded-md sm:overflow-hidden border border-gray-200">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <!-- Photos -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Photos</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative {{ count($images) >= 8 ? 'bg-gray-50' : 'hover:bg-gray-50' }}">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                            <span>Upload files</span>
                                            <input id="file-upload" wire:model="images" type="file" class="sr-only" multiple accept="image/*" {{ count($images) >= 8 ? 'disabled' : '' }}>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                </div>
                            </div>
                            @error('images.*') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            @error('images') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                            <!-- Preview -->
                            @if ($images)
                                <div class="mt-4 grid grid-cols-4 gap-4">
                                    @foreach ($images as $index => $image)
                                        <div class="relative group">
                                            <img src="{{ $image->temporaryUrl() }}" class="h-24 w-full object-cover rounded-md border border-gray-200">
                                            <button type="button" wire:click="removeImage({{ $index }})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Listing Title</label>
                            <input type="text" wire:model="title" id="title" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md px-3 py-2" placeholder="e.g. Vintage Levi's 501 Jeans">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea id="description" wire:model="description" rows="5" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2" placeholder="Describe the item, condition, and any flaws..."></textarea>
                            </div>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-6 gap-6">
                            <!-- Price -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price (Rp)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" wire:model="price" id="price" class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 pr-3 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="0">
                                </div>
                                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Weight -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="weight" class="block text-sm font-medium text-gray-700">Weight (grams)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" wire:model="weight" id="weight" class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-3 pr-12 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="0">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">g</span>
                                    </div>
                                </div>
                                @error('weight') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="category" wire:model="category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Condition -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="condition" class="block text-sm font-medium text-gray-700">Condition</label>
                                <select id="condition" wire:model="condition" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                    <option value="new">New with tags</option>
                                    <option value="like_new">Like New</option>
                                    <option value="good">Good (Minor wear)</option>
                                    <option value="fair">Fair (Visible flaws)</option>
                                </select>
                                @error('condition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Brand -->
                            <div class="col-span-6 sm:col-span-2">
                                <label for="brand" class="block text-sm font-medium text-gray-700">Brand (Optional)</label>
                                <input type="text" wire:model="brand" id="brand" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md px-3 py-2">
                                @error('brand') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Size -->
                            <div class="col-span-6 sm:col-span-2">
                                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                                <input type="text" wire:model="size" id="size" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md px-3 py-2" placeholder="e.g. M, L, 32">
                                @error('size') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-span-6 sm:col-span-2">
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select id="gender" wire:model="gender" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                    <option value="">Select</option>
                                    <option value="men">Men</option>
                                    <option value="women">Women</option>
                                    <option value="unisex">Unisex</option>
                                    <option value="kids">Kids</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 flex justify-end space-x-3 sm:px-6">
                        <button type="button" wire:click="save('draft')" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="save('draft')">Save Draft</span>
                            <span wire:loading wire:target="save('draft')">Saving...</span>
                        </button>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="preview">Preview & Publish</span>
                            <span wire:loading wire:target="preview">Loading...</span>
                        </button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

</div>
</div>
