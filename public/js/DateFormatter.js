class DateFormatter {

    /**
     * @brief Format a date using local time.
     * 
     * Supports the following specifiers:
     * - %Y: full year (e.g., 2014)
     * - %m: month (01-12)
     * - %d: day (01-31)
     * - %H: hour (00-23)
     * - %M: minute (00-59)
     * - %S: second (00-59)
     * 
     * @param {Date} date Date
     * @returns String with date
     */
    static formatLocal(date, format){
        let ret = (' ' + format).slice(1); // Clone format

        ret = ret.replace("%Y",               (date.getFullYear()  ).toString()         );
        ret = ret.replace("%m", Utils.padLeft((date.getMonth   ()+1).toString(), 2, '0'));
        ret = ret.replace("%d", Utils.padLeft((date.getDate    ()  ).toString(), 2, '0'));
        ret = ret.replace("%H", Utils.padLeft((date.getHours   ()  ).toString(), 2, '0'));
        ret = ret.replace("%M", Utils.padLeft((date.getMinutes ()  ).toString(), 2, '0'));
        ret = ret.replace("%S", Utils.padLeft((date.getSeconds ()  ).toString(), 2, '0'));

        let offset = date.getTimezoneOffset();
        let offsetHours   = Math.trunc(offset/60);
        let offsetMinutes = Math.abs(offset - offsetHours * 60);
        let timezone = `UTC${(offset < 0 ? "-" : "+")}${Utils.padLeft(Math.abs(offsetHours).toString(), 2, '0')}:${Utils.padLeft(offsetMinutes.toString(), 2, '0')}`;
        ret = ret.replace("%Z", timezone);

        return ret;
    }

}