function submit_comment(form, auction_id) {
    console.log(form);
    console.log("auction id: " + auction_id);

    // console.log(form.elements);
    contents = document.querySelector('#comment_input').value;

    api.post(`auctions/${auction_id}/comments`, {
        content: contents
    });

    // update_comments(auction_id);
    console.log("ending function");
    return false;
}


// function update_comments() {
//     data = await api.get(`auctions/${auction_id}/comments`);

//     // TODO
// }