import './bootstrap';
import { Modal } from 'bootstrap';
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});




// Loading feature for login,register,forgot/reset password
window.isLoading = function(event, button, spinner='spinner', loading="true"){
    let targetBtn = document.getElementById(button)
    let spinnerBtn = document.getElementById(spinner)

    if(loading){
        spinnerBtn.style.display = "inline-block"
        targetBtn.disabled = true

    }else{
        targetBtn.disabled = false
        spinnerBtn.style.display = "none"
    }

};

window.showModal = () => {
    const myModal = new Modal(document.getElementById('exampleModal'));
    myModal.show();
  }
