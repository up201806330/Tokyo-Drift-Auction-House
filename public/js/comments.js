class Comment {
    constructor(auctionId, userId, date, content){
        this.auctionId = auctionId;
        this.userId    = userId;
        this.date      = date;
        this.content   = content;
    }

    static fromForm(auctionId, form){
        content = form.querySelector('#comment_input').value;
        return new Comment(auctionId, userId, null, content)
    }

    submit() {
        api.post(`auctions/${this.auctionId}/comments`, {
            content: this.content
        });
    
        return false;
    }

    static submit(form, auctionId) {
        let comment = Comment.fromForm(auctionId, form);
        comment.submit();
    
        // update_comments(auction_id);
    }  
}
