<x-layout>
    <section class="px-8 py-8">
        <x-panel class="max-w-sm mx-auto">
            <form action="/admin/posts" method="post" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title" type="text"/>
                <x-form.textarea name="excerpt"/>
                <x-form.textarea name="body"/>
                <x-form.input name="thumbnail" type="file"/>

                <div class="mb-6">
                    <x-form.label name="category"/>
                    <select name="category" id="category"
                            class="py-2 pl-3 pr-9 text-sm font-semibold w-32 text-left lg:inline-flex rounded-xl"
                    >
                        @foreach(App\Models\Category::all() as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category') == $category->id ? 'selected' : '' }}
                            >{{ ucwords($category->name) }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.error name="category"/>
                </div>

                <x-form.button>Publish</x-form.button>
            </form>
        </x-panel>
    </section>
</x-layout>
