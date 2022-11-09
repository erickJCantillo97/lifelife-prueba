<x-app-layout>
    <div class="py-6" x-data="{ modelOpen: false, ModalMasive: false, newDepartamet: false }">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-b border-gray-200">
                <form method="get" action="{{ route('employee', ['employee' => $employee]) }}">
                    <div class="p-2 bg-gray-300 border-b border-gray-200 md:flex block justify-between rounded-md  shadow-sm">
                        <div class="mt-2">
                            <a href="{{ route('dashboard') }}" class="flex bg-yellow-400 p-2 rounded-xl text-base mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                 <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 010 1.06L4.81 8.25H15a6.75 6.75 0 010 13.5h-3a.75.75 0 010-1.5h3a5.25 5.25 0 100-10.5H4.81l4.72 4.72a.75.75 0 11-1.06 1.06l-6-6a.75.75 0 010-1.06l6-6a.75.75 0 011.06 0z" clip-rule="evenodd" />
                                 </svg>
                             </a>
                        </div>
                            
                        <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-4 mr-4">
                            
                            <input type="datetime-local" name="start" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40"
                            name="" id="">
                            <input type="datetime-local" name="end" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40"
                            name="" id="">
                        </div>
                        <div class="flex justify-center mt-2">
                            <button type="submit" class="flex bg-gray-200 p-2 rounded-xl text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                </svg> Filter
                            </button>
                            <a href="{{route('employee', ['employee' => $employee])}}" class="flex bg-gray-200 p-2 rounded-xl text-base mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Clear
                            </a>
                       
                        </div>

                    </div>
                </form>
                <!-- Table format-->
                <div class="overflow-x-auto max-w-full mt-6 ">
                    <div class="justify-start flex mb-4 mx-4">
                        Access history {{$employee->firstname}}  {{$employee->lastname}} 
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 ">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-blod text-black uppercase tracking-wider">
                                    Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-blod text-black uppercase tracking-wider">
                                    Access
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-center">
                            @foreach ($access as $access)
                                <tr>
                                    <td class="p-2 uppercase     whitespace-normal">
                                        {{ $access->datetime }}
                                    </td>
                                    <td class="p-2 uppercase whitespace-normal">
                                        <div class="inline-flex">
                                            @if ($access->canAccess)
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-6 h-6 text-green-400 mr-2">
                                                    <path fill-rule="evenodd"
                                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                                        clip-rule="evenodd" />
                                                </svg> agreed
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-6 h-6 text-red-500 mr-2">
                                                    <path fill-rule="evenodd"
                                                        d="M6.72 5.66l11.62 11.62A8.25 8.25 0 006.72 5.66zm10.56 12.68L5.66 6.72a8.25 8.25 0 0011.62 11.62zM5.105 5.106c3.807-3.808 9.98-3.808 13.788 0 3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788z"
                                                        clip-rule="evenodd" />
                                                </svg> refused
                                            @endif
                                        </div>

                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>     
    </div>

</x-app-layout>
