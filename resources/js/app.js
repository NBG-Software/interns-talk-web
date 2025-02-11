import './bootstrap';


// Loading feature for login,register,forgot/reset password
window.isLoading = function(event, button){
    let targetBtn = document.getElementById(button)
    let spinner = document.getElementById('spinner')
    targetBtn.disabled = true
    spinner.style.display = "inline-block"
};
