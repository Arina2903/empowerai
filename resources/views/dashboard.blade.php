<div class="feature-box">
    🩺 <strong>Skill & Knowledge Recommender</strong><br>
    Learn what your business really needs. Find quick videos and tips!
    <br><br>

    @if(isset($recommendations))
        <h4>You need to improve: <span style="color:#2563EB">{{ $recommendations['topic'] }}</span></h4>

        <ul>
            @foreach ($recommendations['resources'] as $resource)
                <li>
                    <a href="{{ $resource['url'] }}" target="_blank">
                        📺 {{ $resource['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <form action="{{ route('recommend.skills') }}" method="POST">
            @csrf
            <input type="text" name="user_gap" placeholder="e.g. I’m struggling with marketing" required class="rounded p-2 border">
            <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Get Recommendations</button>
        </form>
    @endif
</div>
