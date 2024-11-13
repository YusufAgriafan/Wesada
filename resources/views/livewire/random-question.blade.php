<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
            <h4 class="text-primary mb-4">Kit Permainan</h4>
            <h1 class="display-5 mb-4">Raih Kesuksesan Bisnis Melalui Permainan dan Kolaborasi</h1>
            <p class="mb-0">Permainan WESADA merupakan permainan multi-pemain yang memadukan konsep Monopoli dan Game of Life. Dalam permainan ini, kamu akan menemukan elemen kartu kesempatan, pajak, dan peluang dengan mode-mode yang mendorong kerja sama tim, strategi investasi, dan manajemen keuangan dalam berwirausaha. Jika kamu memiliki pertanyaan tentang cara bermain atau ingin tahu lebih dalam tentang strategi dan pengembangan bisnis di WESADA, jangan ragu untuk menghubungi kami. Tim kami siap membantu kamu untuk meraih kesuksesan dalam permainan ini!
            </p>
        </div>
        
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4 text-center">
                        <b>
                            {{ !$started ? 'Mulai Permainan' : 'Pertanyaan' }}
                        </b>
                    </h2>
        
                    @if (!$started)
                        <div class=" text-center flex justify-center">
                            <button wire:click="startGame" class="btn btn-primary w-100 py-2">
                                Mulai
                            </button>
                        </div>
                    @elseif ($question)
                        <p class="text-gray-700 mb-4">{!! $question->question !!}</p>
        
                        <div class="flex justify-center space-x-4">
                            <button wire:click="revealAnswer" class="btn btn-primary w-32 py-2">
                                Tampilkan Jawaban
                            </button>
                            <button wire:click="getRandomQuestion" class="btn btn-secondary w-32 py-2">
                                Pertanyaan Acak
                            </button>
                        </div>
        
                        @if ($showAnswer)
                            <p class="mt-4 text-green-700 font-semibold text-center">{!! $question->answer !!}</p>
                        @endif
                    @else
                        <p class="text-red-500 text-center">Tidak ada pertanyaan yang tersedia.</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4 text-center"><b>Pemain</b></h2>
                    <div class="space-y-4">
                        @foreach ($players as $index => $player)
                            <div class="text-center border border-gray-300 rounded-lg p-4">
                                <!-- Input Nama Pemain -->
                                <input type="text" wire:model="players.{{ $index }}.name" class="form-input w-full mb-2 text-center font-semibold text-lg border-0 bg-gray-100" placeholder="Nama Pemain {{ $index + 1 }}" />
        
                                <!-- Poin dan Tombol Tambah/Kurang -->
                                <div class="flex items-center justify-between">
                                    <button wire:click="decreasePoints({{ $index }})" class="btn btn-danger px-4 py-1">-5</button>
                                    <span class="text-lg font-bold">{{ $player['points'] }} Poin</span>
                                    <button wire:click="increasePoints({{ $index }})" class="btn btn-success px-4 py-1">+5</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
