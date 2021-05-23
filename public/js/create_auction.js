function privateChange() {
    var input = document.getElementById("private");
    var content = document.getElementById("private_content");
    if (input.checked) {
      content.style.display = "block";
    } else {
      content.style.display = "none";
    }
} 

window.onload = function() {
  elem_start = document.getElementById("startingTime");
  elem_end = document.getElementById("endingTime");

  var iso_start = new Date()
  iso_start.setMinutes(iso_start.getMinutes() + 10);
  var iso_end = iso_start;
  iso_end.setHours(iso_start.getHours() + 8);

  iso_start = iso_start.toISOString();
  iso_end = iso_end.toISOString();

  var minDate_start = iso_start.substring(0,iso_start.length-1);
  var minDate_end = iso_end.substring(0,iso_end.length-1);

  elem_start.value = minDate_start;
  elem_start.min = minDate_start;
  elem_end.value = minDate_end;
  elem_end.min = minDate_end;
}

function validateForm() {
  elem_start = document.getElementById("startingTime");
  elem_end = document.getElementById("endingTime");

  date_start = new Date(elem_start.value);
  date_end = new Date(elem_end.value);
  today = new Date();
  today.setMinutes(today.getMinutes() + 1);

  date_start.setHours(date_start.getHours() + 1);

  if (date_start.getTime() <= today.getTime()) {
    alert("Auction must start no sooner than a minute from now.");
    return false;
  }
  if (date_start.getTime() >= date_end.getTime()) {
    alert("Ending Date must be at least one hour after Starting date.");
    return false;
  }
} 

function updateUsers(){
  let users = document.getElementById("user_rows").children;
  let search_string = document.getElementById("user_search").value;
  
  for (let item of users) {
    let username = item.querySelector(".username").innerHTML;
    if (username.match(search_string.toLowerCase(), "i") == null){
      item.setAttribute('style', 'display:none !important');
    }
    else{
      item.setAttribute('style', 'display:flex !important');
    }
  }
}