function togglePw() {

    var password = document.querySelector('[name=password]');

    if (password.getAttribute('type')==='password') {
      password.setAttribute('type', 'text');
      document.getElementById("font").style.color='orange';
    }
    else {
        password.setAttribute('type','password');
        document.getElementById("font").style.color='black';
    }
  }

  function togglePw2() {
    var password_confirmation = document.querySelector('[name=password_confirmation]');

    if (password_confirmation.getAttribute('type')==='password') {
      password_confirmation.setAttribute('type', 'text');
      document.getElementById("font2").style.color='orange';
    }
    else {
      password_confirmation.setAttribute('type','password');
        document.getElementById("font2").style.color='black';
    }
  }

  function togglePw3() {

    var password = document.querySelector('[id=floatingPassword3]');

    if (password.getAttribute('type')==='password') {
      password.setAttribute('type', 'text');
      document.getElementById("font3").style.color='orange';
    }
    else {
        password.setAttribute('type','password');
        document.getElementById("font3").style.color='black';
    }
  }