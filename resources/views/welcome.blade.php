<x-site-layout title="Real Estate Selling System">
        <div class="flex flex-col w-full lg:w-1/2 justify-center items-start pt-12 pb-24 px-6">
			<p class="uppercase tracking-loose">Welcome</p>
			<h1 class="font-bold text-3xl my-4">Find your home</h1>
			<p class="leading-normal mb-4">Here realtors can publish their real estate listing and visitors can easily contact them to buy or sell properties. This is mainly a listing website to build connection between buyers and sellers.</p>
			<div>
				<div style="float:left">
  					<form action="{{ route('properties.index') }}">
    					<input class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-white rounded shadow hover:shadow-lg py-2 px-4 border border-gray-900 hover:border-transparent" type="submit" value="Properties" />
					</form>
				</div>
				<div style="float:left; margin-left:10px">
					<form action="{{ route('realtors.index') }}">
    					<input class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-white rounded shadow hover:shadow-lg py-2 px-4 border border-gray-900 hover:border-transparent" type="submit" value="Realtors" />
					</form>
				</div>
				@if (Auth::check() && $realtors->where('user_id', Auth::user()->id)->count() == 0)
				<div style="float:left; margin-left:10px">
					<form action="{{ route('realtors.create') }}">
    					<input class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-white rounded shadow hover:shadow-lg py-2 px-4 border border-gray-900 hover:border-transparent" type="submit" value="Create Realtor Profile" />
					</form>
				</div>
				@endif
			</div>
		</div>
		<!--Right Col-->
		<div class="w-full lg:w-1/2 lg:py-6 text-center">
			<!--Add your product image here-->
            <img src = "{{ asset('/images/Real estate logo 13.jpg') }}" width="500"/>
		</div>


</x-site-layout>