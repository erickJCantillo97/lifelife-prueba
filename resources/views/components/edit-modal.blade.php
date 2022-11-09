@props(['employee', 'departaments'])
<!-- Button trigger modal -->
<button type="button"
    class="inline-flex items-center px-6 py-2.5 font-medium text-xs leading-tight uppercase rounded shadow-md  hover:shadow-lg  focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out"
    data-bs-toggle="modal" data-bs-target="#editModal{{ $employee->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2">
        <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0112.548-3.364l1.903 1.903h-3.183a.75.75 0 100 1.5h4.992a.75.75 0 00.75-.75V4.356a.75.75 0 00-1.5 0v3.18l-1.9-1.9A9 9 0 003.306 9.67a.75.75 0 101.45.388zm15.408 3.352a.75.75 0 00-.919.53 7.5 7.5 0 01-12.548 3.364l-1.902-1.903h3.183a.75.75 0 000-1.5H2.984a.75.75 0 00-.75.75v4.992a.75.75 0 001.5 0v-3.18l1.9 1.9a9 9 0 0015.059-4.035.75.75 0 00-.53-.918z" clip-rule="evenodd" />
      </svg>
       Update
</button>

<!-- Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="editModal{{ $employee->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b bg-green-500 border-green-700 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-white" id="exampleModalLabel">
                    Edit Employee {{$employee->firstname}}
                </h5>
                <button type="button"   class="btn-close box-content w-4 h-4 p-1 text-whitex border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-whitex hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></button>
            </div>
            <form  method="post" action="{{route('employees.update', ['employee' => $employee->id])}}">
                @csrf
                <div class="modal-body relative p-4">
                <div class="mt-4 text-left" >
                    <label for="email"  class="block text-sm text-gray-700 capitalize dark:text-gray-200">Employee ID</label>
                    <input required value="{{$employee->employee_id}}" placeholder="arthurmelo@example.app" name="employee_id" type="number" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>

                <div class="mt-4 text-left">
                    <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Frist name</label>
                    <input placeholder="Arthur" required name="firstname" type="text" value="{{$employee->firstname}}" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>

                <div class="mt-4 text-left">
                    <label for="text" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Last
                        name</label>
                    <input placeholder="Melo" required name="lastname" value="{{$employee->lastname}}" type="text"
                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>

                <div class="mt-4">
                    <div class="flex justify-between">
                        <label for="email"
                            class="block text-sm text-gray-700 capitalize dark:text-gray-200">Departament</label>
                        <a class="text-sm text-indigo-400 cursor-pointer" @click="newDepartamet = !newDepartamet"
                            x-text="!newDepartamet ? 'New Departament':'Select Departament'"></a>
                    </div>
                    <select name="departament" id="" x-show="!newDepartamet"
                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @foreach($departaments as $departament)
                        @if($employee->departament_id == $departament->id)
                        <option value="{{$departament->id}}" selected>{{$departament->name}}</option>
                        @else
                        <option value="{{$departament->id}}">{{$departament->name}}</option>
                        @endif
                        
                        @endforeach
                    </select>
                    <input placeholder="arthurmelo@example.app" value="" name="newDepartament" x-show="newDepartamet"
                        type="text"
                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>
            </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <a class="inline-block px-6 py-2.5 cursor-pointer bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Close</a>
                    <button type="sumbit"
                        class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
