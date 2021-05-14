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
}
