class Utils {
    /**
     * Correctly build a date from a date string in UTC time zone.
     * 
     * @param {String} s String containing UTC date
     * @returns Date
     */
    static DateFromUTC(s){
        let date = new Date(s);
        
        let newDate = new Date();
        newDate.setUTCFullYear    (date.getFullYear    ());
        newDate.setUTCMonth       (date.getMonth       ());
        newDate.setUTCDate        (date.getDate        ());
        newDate.setUTCHours       (date.getHours       ());
        newDate.setUTCMinutes     (date.getMinutes     ());
        newDate.setUTCSeconds     (date.getSeconds     ());
        newDate.setUTCMilliseconds(date.getMilliseconds());

        return newDate;
    }

    /**
     * Left-pad a string.
     * 
     * @param {String} s        String to pad
     * @param {Number} n        Minimum number of characters
     * @param {String} filler   Padding string
     */
    static padLeft(s, n, filler){
        let nFillers = n - s.length;
        while(nFillers > 0){
            s = filler + s;
            nFillers--;
        }
        return s;
    }
}
