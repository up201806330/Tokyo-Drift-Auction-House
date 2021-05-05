class Comment {
    constructor(id, auctionId, userId, createdOn, content){
        this.id        = id;
        this.auctionId = auctionId;
        this.userId    = userId;
        this.createdOn = createdOn;
        this.content   = content;
    }

    asElement(){
        let template = document.querySelector('template#comment');
        let ret = template.content.cloneNode(true);
        ret.querySelector('.profile_text').href = `users/${this.userId}`;
        ret.querySelector('.profile_picture_comment').src = `users/${this.userId}/photo`;
        ret.querySelector('.username').innerHTML = this.userId;
        ret.querySelector('.datetime').innerHTML = this.createdOn.toISOString();
        ret.querySelector('.content' ).innerHTML = this.content;
        let form = ret.querySelector('form');
        form.action = `auctions/${this.auctionId}/comments/${this.id}`;
        if(!(userId != null && userId == this.userId)){
            form.style.display = 'none';
        }
        return ret;
    }

    static fromForm(auctionId, form){
        content = form.querySelector('#comment_input').value;
        return new Comment(null, auctionId, userId, null, content)
    }

    submit() {
        return api.post(`auctions/${this.auctionId}/comments`, {
            content: this.content
        });
    }

    static async submit(form, auctionId) {
        let comment = Comment.fromForm(auctionId, form);
        await comment.submit();
    }

    static async updateSection(auctionId){
        let commentsPrimitives = await api.get(`auctions/${auctionId}/comments`).then(response => response.json());
        console.log(commentsPrimitives);

        let commentsEl = document.querySelector("#other-comments");
        while (commentsEl.lastElementChild)
            commentsEl.removeChild(commentsEl.lastElementChild);

        let comments = commentsPrimitives.map(
            commentPrimitive => new Comment(
                commentPrimitive['id'],
                commentPrimitive['auction_id'],
                commentPrimitive['user_id'],
                new Date(commentPrimitive['createdon']),
                commentPrimitive['content']
            )
        );

        comments.sort((a, b) => b.createdOn.getTime() - a.createdOn.getTime());
        console.log(comments);
        for(let comment of comments){
            let commentEl = comment.asElement();
            commentsEl.appendChild(commentEl);
        }
    }
}
