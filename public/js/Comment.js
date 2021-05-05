class Comment {
    constructor(id, auctionId, userId, username, createdOn, content){
        this.id        = id;
        this.auctionId = auctionId;
        this.userId    = userId;
        this.username  = username;
        this.createdOn = createdOn;
        this.content   = content;
    }

    asElement(){
        let template = document.querySelector('template#comment');
        let ret = template.content.cloneNode(true);
        ret.querySelector('.profile_text').href = `users/${this.userId}`;
        ret.querySelector('.profile_picture_comment').src = `users/${this.userId}/photo`;
        ret.querySelector('.username').innerHTML = this.username;
        ret.querySelector('.datetime').innerHTML =
            this.createdOn.getHours    ().toString().padStart(2, '0') + ":" +
            this.createdOn.getMinutes  ().toString().padStart(2, '0') + ":" +
            this.createdOn.getSeconds  ().toString().padStart(2, '0') + " " +
            this.createdOn.getFullYear ().toString().padStart(4, '0') + "-" +
            (this.createdOn.getMonth()+1).toString().padStart(2, '0') + "-" +
            this.createdOn.getDate     ().toString().padStart(2, '0');
        ret.querySelector('.content' ).innerHTML = this.content;
        let form = ret.querySelector('form');
        form.querySelector('input[name="id"]').value = this.id;
        if(!(userId != null && userId == this.userId)){
            form.style.display = 'none';
        }
        return ret;
    }

    static fromSubmitForm(auctionId, form){
        let content = form.querySelector('#comment_input').value;
        return new Comment(null, auctionId, userId, null, null, content);
    }

    static fromDeleteForm(auctionId, form){
        let id = form.querySelector('input[name="id"]').value;
        return new Comment(id, auctionId, null, null, null);
    }

    submit() {
        return api.post(`auctions/${this.auctionId}/comments`, {
            content: this.content
        });
    }

    delete(){
        return api.delete(`auctions/${this.auctionId}/comments/${this.id}`);
    }

    static async submit(form, auctionId) {
        let comment = Comment.fromSubmitForm(auctionId, form);
        await comment.submit();
    }

    static async delete(form, auctionId) {
        let comment = Comment.fromDeleteForm(auctionId, form);
        await comment.delete();
    }

    static async updateSection(auctionId){
        let commentsPrimitives = await api.get(`auctions/${auctionId}/comments`).then(response => response.json());

        let commentsEl = document.querySelector("#other-comments");
        while (commentsEl.lastElementChild)
            commentsEl.removeChild(commentsEl.lastElementChild);

        let comments = commentsPrimitives.map(
            commentPrimitive => new Comment(
                commentPrimitive['id'],
                commentPrimitive['auction_id'],
                commentPrimitive['user_id'],
                commentPrimitive['username'],
                new Date(commentPrimitive['createdon']),
                commentPrimitive['content']
            )
        );

        comments.sort((a, b) => b.createdOn.getTime() - a.createdOn.getTime());
        for(let comment of comments){
            let commentEl = comment.asElement();
            commentsEl.appendChild(commentEl);
        }
    }
}
