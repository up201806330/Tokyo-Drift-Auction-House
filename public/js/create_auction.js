window.onload = function() {
  // Fill starting and ending times and define minimum values accordingly to present
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

  document.getElementById('pro-image').addEventListener('change', readImage, false);
}

function button_click(){
  document.getElementById('pro-image').click();
}

// Show the area to select guests for private auctions
function privateChange() {
    var input = document.getElementById("private");
    var content = document.getElementById("private_content");
    if (input.checked) {
      content.style.display = "block";
    } else {
      content.style.display = "none";
    }
} 

// Validate form on submit -> verify times and place the hidden inputs for guests
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

  let users = document.getElementById("user_rows").children;
  let hidden_users = document.getElementById("hidden_user_rows");
  for (let item of users) {
    let private_user = item.querySelector(".private_user").checked;
    if (private_user){
      let user_id = item.querySelector(".user_id").innerHTML;
      let input = document.createElement("input");
      input.type = "hidden";
      input.name = "invited[]";
      input.value = user_id;
      hidden_users.appendChild(input);
    }
  }
} 

// Update shown users in private auction area according to search
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

let num = 1;
function readImage() {
  if (window.File && window.FileList && window.FileReader) {
      let files = event.target.files; //FileList object
      let output = document.getElementById("preview-images-zone");

      for (let i = 0; i < files.length; i++) {
          let file = files[i];
          if (!file.type.match('image')) continue;
          
          let picReader = new FileReader();
          
          picReader.addEventListener('load', function (event) {
              let picFile = event.target;

              let preview_image = document.createElement("div");
              preview_image.classList.add("preview-image")
              preview_image.id = "preview-show-" + num;

              let delete_button = document.createElement("div");
              delete_button.classList.add("image-cancel");
              delete_button.id = num;
              delete_button.onclick = function(element){
                let no = element.target.id;
                document.getElementById("preview-show-" + no).remove();
              };
              delete_button.innerHTML = "x";

              let image_div = document.createElement("div");
              image_div.classList.add("image-zone");

              let image = document.createElement("img");
              image.id="pro-img-" + num;
              image.classList.add("image-list")
              image.src=picFile.result;

              image_div.appendChild(image);
              preview_image.appendChild(delete_button);
              preview_image.appendChild(image_div);

              output.appendChild(preview_image);
              num = num + 1;
          });

          picReader.readAsDataURL(file);
      }
      document.getElementById("pro-image").value = '';
  } else {
      console.log('Browser not support');
  }
}

