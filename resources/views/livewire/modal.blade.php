<div>
    {{-- <button wire:click="openModal()" type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"> --}}
    <button wire:click="openModal" type="button" class="contact_list_search_modal">
        モーダルを表示
    </button>

    @if($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-12">
                        {{-- <h3 class="text-lg leading-6 font-medium text-gray-900"> --}}
                        <h3 class="modal_title">
                            音声検索
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 contact_list_modal_text">
                                内容はここに表示されます。
                            </p>
                        </div>
                    </div>
                    <!-- 音声検索のマイクアイコン -->
                    <div class="contact_list_modal_icon">
                        <div class="contact_list_modal_icon_mike">テスト</div>
                    </div>

                    <button id="start-btn">start</button>
                    <button id="stop-btn">stop</button>
                    <div id="result-div"></div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                            閉じる
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.sent', (message, component) => {
                if (message.updateQueue && message.updateQueue[0] && message.updateQueue[0].payload) {
                    const payload = message.updateQueue[0].payload;

                    // モーダルが更新される時の処理
                    if (payload.method === 'showModal') {
                        initJS();
                    }
                }
            });
        });

        function initJS() {
            const startBtn = document.querySelector('#start-btn');
            const stopBtn = document.querySelector('#stop-btn');
            const resultDiv = document.querySelector('#result-div');

            if (startBtn && stopBtn && resultDiv) {
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                const recognition = new SpeechRecognition();

                recognition.lang = 'ja-JP';
                recognition.interimResults = true;
                recognition.continuous = true;

                let finalTranscript = ''; // 確定した(黒の)認識結果

                recognition.onresult = (event) => {
                    let interimTranscript = ''; // 暫定(灰色)の認識結果
                    for (let i = event.resultIndex; i < event.results.length; i++) {
                        let transcript = event.results[i][0].transcript;
                        if (event.results[i].isFinal) {
                            finalTranscript += transcript;
                        } else {
                            interimTranscript = transcript;
                        }
                    }
                    resultDiv.innerHTML = finalTranscript + '<i style="color:#ddd;">' + interimTranscript + '</i>';
                }

                startBtn.onclick = () => {
                    recognition.start();
                }

                stopBtn.onclick = () => {
                    recognition.stop();
                }
            } else {
                console.error("要素が見つかりませんでした。");
            }
        }
    </script>
@endpush
