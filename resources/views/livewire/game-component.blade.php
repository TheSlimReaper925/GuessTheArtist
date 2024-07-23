<div>
    <div class="header-container">
        <img src="{{ asset('assets/images/'.$questionArray[0]['filename']) }}" alt="Background Image" class="background-image">
        <div class="header">
            <span class="line"></span>
            <span class="header-text">გამოიცანი მხატვარი</span>
            <span class="line"></span>
        </div>
    </div>
    <div class="button-container">
        <div class="button-row">
            <button class="custom-button" wire:click="selectAnswer(0)">
                {{$questionArray[0]['answers'][0]}}
            </button>
            <button class="custom-button" wire:click="selectAnswer(1)">
                {{$questionArray[0]['answers'][1]}}
            </button>
        </div>
        <div class="button-row">
            <button class="custom-button" wire:click="selectAnswer(2)">
                {{$questionArray[0]['answers'][2]}}
            </button>
            <button class="custom-button" wire:click="selectAnswer(3)">
                {{$questionArray[0]['answers'][3]}}
            </button>
        </div>
    </div>
</div>
