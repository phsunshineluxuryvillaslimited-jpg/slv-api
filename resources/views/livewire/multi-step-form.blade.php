<section>
    {{ $currentStep }}
    <livewire:property.dotted-steps :step="Hello World" />
   
    @if ( $currentStep == 1 )
        <livewire:property.reference-form />
    @endif

    @if ( $currentStep == 2 )
        <livewire:property.location-form />
    @endif

</section>