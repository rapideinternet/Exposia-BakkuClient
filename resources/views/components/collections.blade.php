{{--
    $type: string
    $results: array

    You can use this component to loop through a collection of items and display them in a specific way based on the type.
--}}

@if($type == 'employees')
    @foreach($results as $employee)
        {{-- Your HTML goes here --}}
    @endforeach
@elseif($type == 'casesSlider')
    @foreach($results as $case)
        {{-- Your HTML goes here --}}
    @endforeach
@endif
