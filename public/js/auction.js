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