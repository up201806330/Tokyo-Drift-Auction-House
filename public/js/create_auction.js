window.onload = function() {
  // add listener for image input
  document.getElementById('pro-image').addEventListener('change', readImage, false);
}

function button_click(){
  document.getElementById('pro-image').click();
}

// Show the area to select guests for private auctions
function privateChange() {
    let input = document.getElementById("private");
    let content = document.getElementById("private_content");
    if (input.checked) {
      content.style.display = "block";
    } else {
      content.style.display = "none";
    }
} 

function animationErrorFormSubmit(error_text) {
  let notif = document.getElementById("upload_error");
  notif.classList.remove('notification')
  notif.classList.add('notification');
  notif.style.display = "block";

  var elm = notif;
  var newone = elm.cloneNode(true);
  elm.parentNode.replaceChild(newone, elm);
  let notif_text = document.getElementById("notification_text");
  notif_text.innerHTML = error_text;
}

function validateForm() {
  //verify times
  date_start = document.getElementById("startingDate").value;
  time_start = document.getElementById("startingTime").value;
  date_end = document.getElementById("endingDate").value;
  time_end = document.getElementById("endingTime").value;

  date_time_start = new Date(date_start + "T" +  time_start);
  date_time_end = new Date(date_end + "T" +  time_end);
  today = new Date();
  today.setMinutes(today.getMinutes() + 1);

  date_time_start.setHours(date_time_start.getHours() + 1);

  if (date_time_start.getTime() <= today.getTime()) {
    animationErrorFormSubmit("Auction must start no sooner than a minute from now.");
    return false;
  }
  if (date_time_start.getTime() >= date_time_end.getTime()) {
    animationErrorFormSubmit("Ending Date must be at least one hour after Starting date.");
    return false;
  }

  //check if there is at least one photo
  let hidden_pictures = document.getElementById("hidden-input-pictures").children;
  if (hidden_pictures.length == 0){

    animationErrorFormSubmit("You must upload at least one photo!!");

    return false;
  }

  //Private auction handling
  var input = document.getElementById("private");
   if (input.checked) {
    let users = document.getElementById("user_rows").children;
    
    let at_least_one_user = false;
    //place the hidden inputs for guests
    let hidden_users = document.getElementById("hidden_user_rows");
    for (let item of users) {
      let private_user = item.querySelector(".private_user").checked;
      if (private_user){
        at_least_one_user = true;
        let user_id = item.querySelector(".user_id").innerHTML;
        let input = document.createElement("input");
        input.type = "hidden";
        input.name = "invited[]";
        input.value = user_id;
        hidden_users.appendChild(input);
      }
    }

    //check if there is at least one invited guest
    if (!at_least_one_user){
      animationErrorFormSubmit("If your auction is private, you must select at least one invited user.");
      return false;
    }
  }

  //Moderators
  let users = document.getElementById("moderator_rows").children;

  //place the hidden inputs for moderators
  let hidden_users = document.getElementById("hidden_moderator_rows");
  for (let item of users) {
    let private_user = item.querySelector(".moderator_user").checked;
    if (private_user){
      let user_id = item.querySelector(".user_id").innerHTML;
      let input = document.createElement("input");
      input.type = "hidden";
      input.name = "moderator[]";
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

// Update shown users in private auction area according to search
function updateModerators(){
  let users = document.getElementById("moderator_rows").children;
  let search_string = document.getElementById("moderator_search").value;
  
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
      let hidden_pictures = document.getElementById("hidden-input-pictures");

      for (let i = 0; i < files.length; i++) {
          let file = files[i];
          if (!file.type.match('image')) continue;
          
          let picReader = new FileReader();

          picReader.addEventListener('load', function (event) {
              //create hidden input for for submission
              let input = document.createElement("input");
              input.type = "file";
              input.name = "picture[]";
              input.classList.add("d-none");

              const dataTransfer = new DataTransfer();
              dataTransfer.items.add(file);
              input.files = dataTransfer.files;
              hidden_pictures.appendChild(input);

              //create picture preview
              let picFile = event.target;

              let preview_image = document.createElement("div");
              preview_image.classList.add("preview-image")
              preview_image.id = "preview-show-" + num;

              //add delete button to image preview
              let delete_button = document.createElement("div");
              delete_button.classList.add("image-cancel");
              delete_button.id = num;
              delete_button.onclick = function(element){
                let no = element.target.id;
                document.getElementById("preview-show-" + no).remove();
                input.remove();
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
      //clear input
      document.getElementById("pro-image").value = '';
  } else {
      console.log('Browser not support');
  }
}

