
class CountdownClock {
    constructor(startDate, callback){
        this.begin = startDate;
        this.callback = callback;
        this.timer = null;
    }

    start(){
        let self = this;
        this.timer = setInterval(() => self.run(), 100);
    }

    run(){
        let now = new Date();

        let t = now.getTime() - this.begin.getTime();

        this.callback(t);
    }
}
