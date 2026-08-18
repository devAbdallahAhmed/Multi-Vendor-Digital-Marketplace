@if ($counterSection)
    <section class="premium-performance-sec">
        <div class="perf-glow-1"></div>
        <div class="perf-glow-2"></div>

        <div class="container container-two">
            <div class="row gy-5 align-items-center flex-wrap-reverse">

                <div class="col-lg-5">
                    <div class="perf-left-content">
                        <h3 class="perf-title">{{ $counterSection->title }}</h3>
                        <p class="perf-desc">{{ $counterSection->subtitle }}</p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="perf-stats-grid">

                        <div class="perf-stat-card">
                            <div class="perf-number">{{ number_format($counterSection->counter_1) }}+</div>
                            <div class="perf-label">{{ $counterSection->label_1 }}</div>
                        </div>

                        <div class="perf-stat-card">
                            <div class="perf-number">{{ number_format($counterSection->counter_2) }}+</div>
                            <div class="perf-label">{{ $counterSection->label_2 }}</div>
                        </div>

                        <div class="perf-stat-card">
                            <div class="perf-number">{{ number_format($counterSection->counter_3) }}+</div>
                            <div class="perf-label">{{ $counterSection->label_3 }}</div>
                        </div>

                        <div class="perf-stat-card">
                            <div class="perf-number">{{ number_format($counterSection->counter_4) }}+</div>
                            <div class="perf-label">{{ $counterSection->label_4 }}</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
