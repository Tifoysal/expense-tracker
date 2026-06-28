<div class="flex flex-col items-center">

    {{-- Employee Card --}}
    
    <div
        class="group relative bg-white/90 backdrop-blur border border-gray-200 rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 min-w-[260px] overflow-hidden">

        {{-- Top Gradient --}}
        <div
            class="h-2 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-400">
        </div>

        <div class="p-5">

            {{-- Profile Section --}}
            <div class="flex flex-col items-center">

                {{-- Avatar --}}
                <div
                    class="relative w-20 h-20 rounded-2xl overflow-hidden ring-4 ring-blue-50 shadow-md">

                    <img
                        src="{{ $employee->image ?? asset('default-avatar.png') }}"
                        alt="{{ $employee->name }}"
                        class="w-full h-full object-cover">

                    {{-- Online Dot --}}
                    <div
                        class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full">
                    </div>

                </div>

                {{-- Name --}}
                <h3 class="mt-4 text-lg font-bold text-gray-800 text-center">
                  <a href="{{route('employee.organogram',$employee->id)}}">{{ $employee->name }}</a>  
                </h3>

                {{-- Designation --}}
                <p class="text-sm text-gray-500 text-center">
                    {{ $employee->designation->name ?? 'No Designation' }}
                </p>

            </div>

            {{-- Stats --}}
            <!-- <div
                class="mt-5 flex items-center justify-center gap-3">

                <div
                    class="px-3 py-2 bg-blue-50 rounded-xl text-center min-w-[90px]">
                    <p class="text-xs text-gray-500">
                        Team
                    </p>

                    <p class="text-sm font-bold text-blue-600">
                        {{ $employee->subordinates_count }}
                    </p>
                </div>

                <div
                    class="px-3 py-2 bg-purple-50 rounded-xl text-center min-w-[90px]">
                    <p class="text-xs text-gray-500">
                        ID
                    </p>

                    <p class="text-sm font-bold text-purple-600">
                        #{{ $employee->id }}
                    </p>
                </div>

            </div> -->

            {{-- Action Button --}}
            @if($employee->subordinates_count > 0)

                <button
                    wire:click="loadChildren"
                    wire:loading.attr="disabled"
                    class="mt-5 w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-blue-500 text-black font-medium shadow hover:shadow-lg hover:scale-[1.02] active:scale-95 transition-all duration-200">

                    {{-- Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>

                    <span wire:loading.remove>
                        {{ $expanded
                            ? 'Hide Team'
                            : 'Show Team (' . $employee->subordinates_count . ')'
                        }}
                    </span>

                    <span wire:loading>
                        Loading...
                    </span>

                </button>

            @endif

        </div>

    </div>



    {{-- Connector Logic --}}
    @if($expanded)
        {{-- Vertical trunk down from parent (1px solid black) --}}
        <div class="w-px h-8 border-l border-black"></div>

        <div class="flex">
            @foreach($children as $child)
                <div class="relative flex flex-col items-center">
                    
                    {{-- Horizontal Shoulder Line (1px solid black) --}}
                    <div class="absolute top-0 left-0 right-0 border-t border-black
                        {{ $loop->first && $loop->last ? 'hidden' : '' }} 
                        {{ $loop->first ? 'left-1/2' : '' }} 
                        {{ $loop->last ? 'right-1/2' : '' }}">
                    </div>

                    {{-- Vertical neck line to child (1px solid black) --}}
                    <div class="w-px h-8 border-l border-black"></div>

                    {{-- Child Node --}}
                    <div class="px-4">
                        <livewire:organogram-node
                            :employee="$child"
                            :key="$child->id"
                        />
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>