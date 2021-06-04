class PasswordInput {
    /**
     * @brief Toggle a password.
     * 
     * This allows the user to confirm the password if he/she needs to.
     * 
     * @param {DOMElement} el Clickable element signalling if password visibility is toggled
     * @param {String} name Name of the input field to be toggled
     */
    static toggle(el, password) {
        if (password.getAttribute('type') === 'password') {
            password.setAttribute('type', 'text');
            el.style.color = 'orange';
        } else {
            password.setAttribute('type', 'password');
            el.style.color = 'black';
        }
    }

    static compare(el1, el2) {
        var password1 = el1.value;
        var password2 = el2.value;

        if (password1.length < 8) {
            var hidden_div_1 = document.querySelector('[id="passwords-not-big"');
            hidden_div_1.style.display = 'block';
            return false;
        }

        if (password1 != password2) {
            var hidden_div_2 = document.querySelector('[id="passwords-not-match"');
            hidden_div_2.style.display = 'block';
            return false;
        }
        else { return true; }
    }
}
