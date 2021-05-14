
class CountdownClock {
    constructor(startDate, endDate){
        this.startDate = startDate;
        this.endDate = endDate;
        this.timer = null;

        console.log(this.startDate);
        console.log(this.endDate);
    }

    start(){
        let self = this;
        this.timer = setInterval(() => self.run(), 1000);
    }

    run(){
            let nowTime = new Date().getTime();

            let startTime = this.startDate.getTime();
            let endTime = this.endDate.getTime();

            let t;

            if (nowTime < startTime) { console.log("here"); t = startTime - nowTime; }
            else { t = endTime - nowTime; }

            if (t > 0) {

                let days = Math.floor(t / (1000 * 60 * 60 * 24));
                // prefix any number below 10 with a "0" E.g. 1 = 01
                if (days < 10) { days = "0" + days; }
                
                // calculate hours
                let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                if (hours < 10) { hours = "0" + hours; }
            
                // calculate minutes
                let mins = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                if (mins < 10) { mins = "0" + mins; }

                // calculate seconds
                let secs = Math.floor((t % (1000 * 60)) / 1000);
                if (secs < 10) { secs = "0" + secs; }
        
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
