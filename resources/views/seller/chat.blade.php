<x-seller.layout>
    <x-slot:title>
        Wesada - Chat AI
    </x-slot>

    <div class="container">
        <h1>Generate Chat Content</h1>
        <form id="chatForm" action="{{ route('seller.generateContent') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="chat" class="form-label">Chat Input</label>
                <textarea class="form-control" id="chat" name="chat" rows="3" required></textarea>
            </div>
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button type="submit" id="sendButton" class="btn btn-primary mb-3">Generate</button>
        </form>
        <form id="analisisForm" action="{{ route('seller.analisisManajemen') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button type="submit" class="btn btn-primary">Lakukan Analisis</button>
        </form>

        <div id="responseContainer" class="mt-3">
            @if(isset($chat))
                <h4>Your Chat:</h4>
                <p>{{ $chat->chat }}</p>
                <h4>AI Response:</h4>
                <div class="ai-response">
                    {!! $chat->answer !!}
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .ai-response {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 15px;
            background-color: #f9f9f9;
            margin-top: 10px;
        }
    </style>
</x-seller.layout>
