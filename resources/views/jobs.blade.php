<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    
    <h1>Jobs Listing</h1>
  
    <ul>
        @foreach ($jobs as $job)
         <li>
            <a href="/jobs/{{ $job['id'] }}">
                <strong>Title: {{ $job['title'] }}</strong>, Salary: {{ $job['salary'] }} per month 
            </a>
         </li> 
        @endforeach
        
    </ul>

</x-layout>