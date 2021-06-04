class ResetPassword {
    constructor(parent, email){
        this.parent = parent;
        this.email  = email;

        this.confirmationEl = this.parent.querySelector('#password-reset-confirmation' );
        this.throttledEl    = this.parent.querySelector('#password-reset-throttled'    );
        this.genericErrorEl = this.parent.querySelector('#password-reset-generic-error');
    }

    static fromForm(el){
        return new ResetPassword(el.parentNode, el.querySelector("input[name='email']").value);
    }

    submit() {
        this.confirmationEl.style.display = 'none';
        this.throttledEl   .style.display = 'none';
        this.genericErrorEl.style.display = 'none';

        return api.post(`password/reset/email`, {
            email: this.email
        });
    }

    async processResponse(response){
        let json = await response.json();

        switch(response.status){
            case 200: this.confirmationEl.style.display = 'block'; break;
            case 422:
                if(json.error === "throttled"){ this.throttledEl.style.display = 'block'; break; }
            default:
                this.genericErrorEl.innerHTML = `Unknown error: ${response.status} (${response.statusText}). Reason: ${json.error}`;
                this.genericErrorEl.style.display = 'block';
        }
    }
}
