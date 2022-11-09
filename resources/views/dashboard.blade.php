<x-app-layout>
    <div class="py-6" x-data="{ modelOpen: false, ModalMasive: false, newDepartamet: false }">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-b border-gray-200"> 
                <form method="get" action="{{route('dashboard')}}">
                <div
                    class="p-2 bg-gray-300 border-b border-gray-200 md:flex block justify-between rounded-md  shadow-sm">
                   
                        <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-4 mr-4">

                            <input type="search" name="search" value="{{$search}}"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40"
                                placeholder="Search...">

                            <select name="departament" value="{{$search}}" id="" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring uppercase focus:ring-indigo-300 focus:ring-opacity-40">
                                <option value="">Filter Departament</option>
                                @foreach($departaments as $departament)
                                <option value="{{$departament->id}}">{{$departament->name}}</option>
                                @endforeach
                            </select>
                            
                          
                        </div>
                        <div class="flex justify-center mt-2">
                            <button type="submit" class="flex bg-gray-200 p-2 rounded-xl text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                </svg> Filter
                            </button>
                            <a href="{{route('dashboard')}}" class="flex bg-gray-200 p-2 rounded-xl text-base mx-4">
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
                    <div class="justify-end flex mb-4 mx-4">
                        <a @click="modelOpen = !modelOpen"
                            class="p-2 cursor-pointer border border-blue-500 text-blue-500 rounded-lg hover:bg-blue-500 hover:text-white">New
                            Employee</a>
                        <a @click="ModalMasive = !ModalMasive"
                            class="mx-2 p-2 cursor-pointer border border-blue-500 text-blue-500 rounded-lg hover:bg-blue-500 hover:text-white">Upload
                            CSV</a>
                        <a href="{{route('exportPDF')}}" target="_blank"
                            class="mx-2 p-2 cursor-pointer border border-blue-500 text-blue-500 rounded-lg hover:bg-blue-500 hover:text-white">Export
                            PDF</a>

                    </div>
                    <table class="min-w-full divide-y divide-gray-200 ">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-blod text-black uppercase tracking-wider">
                                    Employee ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-blod text-black uppercase tracking-wider">
                                    First Name ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-blod text-black uppercase tracking-wider">
                                    Lastname
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-blod text-black uppercase tracking-wider">
                                    Departament
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-blod text-black uppercase tracking-wider">
                                    Total Access
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-blod text-black uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-center">
                            @foreach($employees as $employee)
                            <tr>
                                <td class="p-2 uppercase     whitespace-normal">
                                    {{$employee->employee_id}}
                                </td>
                                <td class="p-2 uppercase whitespace-normal">
                                    {{$employee->firstname}}
                                </td>

                                <td class="p-2 uppercase whitespace-normal">
                                    {{$employee->lastname}}
                                </td>

                                <td class="p-2 uppercase whitespace-normal">
                                    {{$employee->departament->name}}
                                </td>
                                <td class="p-2  whitespace-normal">
                                    {{$employee->access->where('canAccess', 1)->count()}}
                                </td>
                                <td class="p-2  whitespace-normal">
                                    <div class="flex justify-between">
                                        <x-edit-modal :employee="$employee" :departaments="$departaments">
                                        </x-edit-modal>
                                        <form action="{{route('dissabled')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$employee->id}}">
                                            <input type="hidden" name="status" value="{{$employee->dissabled}}">
                                            <button type="submit"
                                                class="inline-flex items-center px-6 py-2.5 font-medium text-xs leading-tight uppercase rounded shadow-md hover:shadow-lg  focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
                                                @if($employee->dissabled)
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-6 h-6 mr-2 text-red-500">
                                                    <path
                                                        d="M10.375 2.25a4.125 4.125 0 100 8.25 4.125 4.125 0 000-8.25zM10.375 12a7.125 7.125 0 00-7.124 7.247.75.75 0 00.363.63 13.067 13.067 0 006.761 1.873c2.472 0 4.786-.684 6.76-1.873a.75.75 0 00.364-.63l.001-.12v-.002A7.125 7.125 0 0010.375 12zM16 9.75a.75.75 0 000 1.5h6a.75.75 0 000-1.5h-6z" />
                                                </svg> Inactive
                                                @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-6 h-6 mr-2 text-green-400">
                                                    <path
                                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                </svg> Active
                                                @endif
                                            </button>
                                        </form>
                                     
                                        <a href="{{route('employee', ['employee' => $employee])}}" class="inline-flex items-center px-6 py-2.5 font-medium text-xs leading-tight uppercase rounded shadow-md hover:shadow-lg  focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6 mr-2 text-yellow-400">
                                                        <path fill-rule="evenodd"
                                                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z"
                                                            clip-rule="evenodd" />
                                                        <path
                                                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                                                    </svg> History
                                            </a>
                                        <x-delete-modal :employee="$employee"></x-delete-modal>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal New Employee -->
        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">New Employee</h1>

                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 ">
                        Add new Employee to list
                    </p>

                    <form class="mt-5" method="post" action="{{route('employees.store')}}">
                        @csrf
                        <div class="mt-4">
                            <label for="email"
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200">Employee ID</label>
                            <input required placeholder="arthurmelo@example.app" name="employee_id" type="number"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                        <div>
                            <label for="user name"
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200">Frist name</label>
                            <input placeholder="Arthur" required name="firstname" type="text"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>

                        <div class="mt-4">
                            <label for="text" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Last
                                name</label>
                            <input placeholder="Melo" required name="lastname" type="text"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>

                        <div class="mt-4">
                            <div class="flex justify-between">
                                <label for="email"
                                    class="block text-sm text-gray-700 capitalize dark:text-gray-200">Departament</label>
                                <a class="text-sm text-indigo-400 cursor-pointer"
                                    @click="newDepartamet = !newDepartamet"
                                    x-text="!newDepartamet ? 'New Departament':'Select Departament'"></a>
                            </div>
                            <select name="departament" id="" x-show="!newDepartamet"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                @foreach($departaments as $departament)
                                <option value="{{$departament->id}}">{{$departament->name}}</option>
                                @endforeach
                            </select>
                            <input placeholder="arthurmelo@example.app" value="" name="newDepartament"
                                x-show="newDepartamet" type="text"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>



                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Load csv -->
        <div x-show="ModalMasive" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="ModalMasive = false" x-show="ModalMasive"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-cloak x-show="ModalMasive" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Massive load of employees</h1>

                        <button @click="ModalMasive = false"
                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <form class="mt-5" action="{{route('employees.loadMasive')}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="file"
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200">File</label>
                            <input required placeholder="Elegir un Archivo" type="file" name="file"
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>



                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
