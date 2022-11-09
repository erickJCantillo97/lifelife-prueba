<x-guest-layout>
<main class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">
	<h1 class="text-9xl font-extrabold text-white tracking-widest">Welcome</h1>
	<div class="bg-[#FF6A3D] px-2 rounded rotate-12 absolute text-lg">
		{{$employee->firstname}} {{$employee->lastname}}
	</div>
	<button class="mt-5">
      <a
        class="relative inline-block text-sm font-medium text-[#FF6A3D] group active:text-orange-500 focus:outline-none focus:ring"
      >
        

        <a href="/" class="relative block px-8 py-3 bg-[#1A2238] border border-[#FF6A3D] text-[#FF6A3D] translate-x-2 rounded-md">
          Go Home
        </a>
      </a>
    </button>
</main>
</x-guest-layout>