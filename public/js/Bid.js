class Bid {
    constructor(id, auctionId, userId, username, createdOn, amount){
        this.id        = id;
        this.auctionId = auctionId;
        this.userId    = userId;
        this.username  = username;
        this.createdOn = createdOn;
        this.amount    = amount;
    }

    static fromForm(auctionId, form){
        let amount = form.querySelector('input[name="amount"]').value;
        return new Bid(null, auctionId, userId, null, null, amount);
    }

    submit() {
        return api.post(`auctions/${this.auctionId}/bids`, {
            amount: this.amount
        });
    }

    static async submit(form, auctionId) {
        let bid = Bid.fromForm(auctionId, form);
        await bid.submit();
    }

    static async updateSection(auctionId){
        let bidPrimitive = await api.get(`auctions/${auctionId}/bids/highest`).then(response => response.json());
        let bid = new Bid(
            bidPrimitive['id'],
            bidPrimitive['auction_id'],
            bidPrimitive['user_id'],
            bidPrimitive['username'],
            new Date(bidPrimitive['createdon']),
            bidPrimitive['amount']
        )

        document.querySelector("#max-bid").innerHTML = `${bid.amount}€`;
        document.querySelector("#max-bidder-anchor").href = `users/${bid.userId}`;
        document.querySelector("#max-bidder-img").src = `users/${bid.userId}/photo`;
        document.querySelector("#max-bidder-username").innerHTML = bid.username;
        document.querySelector("#bid_input").min = bid.amount+1;
        document.querySelector("#bid_input").value = bid.amount+1;
    }
}
