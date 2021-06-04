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
}
