
// 音声認識の設定
const startBtn = document.querySelector('#contact_list_voice_search_start');
const stopBtn = document.querySelector('#contact_list_voice_search_stop');
const resultInput = document.querySelector('#contact_list_voice_search_result');

    if (startBtn && stopBtn && resultInput) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition = new SpeechRecognition();

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
        // resultInput.innerHTML = finalTranscript + '<i style="color:#ddd;">' + interimTranscript + '</i>';
        resultInput.value = finalTranscript + interimTranscript;
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

// リセットする設定
var clear = document.getElementById('contact_list_search_reload_clear');
    clear.addEventListener('click', function(event) {
        const url = new URL(location);
        location.reload();
    history.replaceState('', '', 'http://localhost/contact/list');
    });
