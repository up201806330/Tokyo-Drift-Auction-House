
class CountdownClock {
    constructor(startDate, endDate){
        this.begin = startDate;
        this.end = endDate;
        this.timer = null;
    }

    start(){
        let self = this;
        this.timer = setInterval(() => self.run(), 1000);
    }

    run(){
            let now = new Date();

            let t = (now < this.begin ? this.begin.getTime() : this.end.getTime()) - now.getTime();

            if (t > 0) {

                let days  = Utils.padLeft(Math.floor((t                        ) / (1000 * 60 * 60 * 24)).toString(), 2, '0'); // calculate days
                let hours = Utils.padLeft(Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60     )).toString(), 2, '0');  // calculate hours
                let mins  = Utils.padLeft(Math.floor((t % (1000 * 60 * 60     )) / (1000 * 60          )).toString(), 2, '0'); // calculate minutes
                let secs  = Utils.padLeft(Math.floor((t % (1000 * 60          )) / (1000               )).toString(), 2, '0'); // calculate seconds
        
                // Set time on document
                document.querySelector('#days').innerText = days;
                document.querySelector('#hours').innerText = hours;
                document.querySelector('#minutes').innerText = mins;
                document.querySelector('#seconds').innerText = secs;
            } else {
                // Set time on document
                document.querySelector('#days').innerText = "00";
                document.querySelector('#hours').innerText = "00";
                document.querySelector('#minutes').innerText = "00";
                document.querySelector('#seconds').innerText = "00";
            }
    }
}
