import './bootstrap';
import { Modal } from 'bootstrap';

// Loading feature for login,register,forgot/reset password
window.isLoading = function(event, button, spinner='spinner'){
    let targetBtn = document.getElementById(button)
    let spinnerBtn = document.getElementById(spinner)
    targetBtn.disabled = true
    spinnerBtn.style.display = "inline-block"
};

window.showModal = () => {
    const myModal = new Modal(document.getElementById('exampleModal'));
    myModal.show();
  }
