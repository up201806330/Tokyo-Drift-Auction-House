
class CountdownClock {
    constructor(startDate, endDate, callback){
        this.begin = startDate;
        this.end = endDate;
        this.callback = callback;
        this.timer = null;
    }

    start(){
        let self = this;
        this.timer = setInterval(() => self.run(), 1000);
    }

    run(){
        let now = new Date();

        let t = (now < this.begin ? this.begin.getTime() : this.end.getTime()) - now.getTime();

        this.callback(t);
    }
}
