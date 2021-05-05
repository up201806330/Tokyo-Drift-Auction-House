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
    var password2 = document.querySelector('[name=password2]');

    if (password2.getAttribute('type')==='password') {
      password2.setAttribute('type', 'text');
      document.getElementById("font2").style.color='orange';
    }
    else {
        password2.setAttribute('type','password');
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