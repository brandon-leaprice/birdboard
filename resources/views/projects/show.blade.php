<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full px-5">
            <p class="font-normal text-gray-400 text-sm py-4">
                <a href="/projects">My Project</a> / {{$project->title}}
            </p>
            <a href="" class="text-white px-6 py-2 font-medium bg-blue-400 rounded shadow">New project</a>
        </div>
    </header>

    <div class="lg:flex">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h2 class="font-normal text-lg text-gray-400 py-4 mb-3">Tasks</h2>

                @forelse($project->tasks as $task)
                    <div class="bg-white  p-5 rounded-lg shadow mb-3">
                        {{$task->body}}
                    </div>
                @empty
                    <div class="bg-white  p-5 rounded-lg shadow mb-3">
                        <form method="POST" action="{{ $project->path() . '/tasks' }}">
                            @csrf
                            <input name="body" type="text" placeholder="Being Adding Tasks..." class="w-full">
                        </form>
                    </div>
                @endforelse
                

            </div>


           <div class="mb-8">
               <h2 class="font-normal text-lg text-gray-400 py-4 mb-3">General Notes</h2>

               <textarea style="min-height: 200px" class="bg-white border-none p-5 rounded-lg shadow w-full">Lorem Ipsum</textarea>
           </div>
        </div>

        <div class="lg:w-1/4 px-3 mt-16 pt-1.5">
            <div class="bg-white  p-5 rounded-lg shadow" style="height: 200px;">
                <h3 class="font-normal text-xl py-4 pl-4 mb-3 -ml-5 border-l-4 border-blue-400">
                    <a href="{{ $project->path() }}">{{$project->title }}</a>
                </h3>

                <div class="text-gray-400">{{ \Illuminate\Support\Str::limit($project->description, 250) }}</div>
            </div>
        </div>
    </div>


</x-app-layout>
