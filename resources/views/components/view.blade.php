<a href="/event/1" class="event-card-link">
    <div class="event-card">
        <div class="card-image">
            <img src="{{ $image }}" alt="{{ $title }}">
        </div>
        <div class="card-body">
            <h3 class="event-title">{{ $title }}</h3>
            <p class="event-date">
                <span class="icon-calendar">📅</span> {{ $date }}
            </p>
            <p class="event-price">Rp{{ number_format($price, 0, ',', '.') }}</p>
            
            <div class="card-footer">
                <div class="organizer-info">
                    <img src="{{ $organizerLogo }}" alt="Logo" class="org-logo">
                    <span class="org-name">{{ $organizerName }}</span>
                </div>
            </div>
        </div>
    </div>
</a>