<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full px-5">
            <h class="font-normal text-gray-400 text-sm py-4">My Project</h>
            <a href="" class="text-white px-6 py-2 font-medium bg-blue-400 rounded shadow">New project</a>
        </div>
    </header>


    <div class="lg:flex lg:flex-wrap">
        @forelse($projects as $project)

            <div class="lg:w-1/3 px-3 pb-6">
                <div class="bg-white  p-5 rounded-lg shadow" style="height: 200px;">
                    <h3 class="font-normal text-xl py-4 pl-4 mb-3 -ml-5 border-l-4 border-blue-400">
                        <a href="{{ $project->path() }}">{{$project->title }}</a>
                    </h3>

                    <div class="text-gray-400">{{ \Illuminate\Support\Str::limit($project->description, 250) }}</div>
                </div>
            </div>
        @empty

        <div>No Project Found</div>

        @endforelse
    </div>
</x-app-layout>
