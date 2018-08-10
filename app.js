const moment = require('moment')
const monitorClipboard = require('./monitor-clipboard')

const calcMinutes = timeString => {
    const minutesPerDay = 8 * 60
    const lineRegex = /^([0-9]{3,4}) ([0-9]{4})[ ]{1,3}([0-9]{4}) ([0-9]{4})$/
    const parts = timeString.replace("_", "0").match(lineRegex)

    if (parts === null) return ''

    const morning = moment(parts[2], 'HH:mm').diff(moment(parts[1], 'HH:mm'), 'minutes')
    const afternoon = moment(parts[4], 'HH:mm').diff(moment(parts[3], 'HH:mm'), 'minutes')
    const minutes = (morning + afternoon) - minutesPerDay

    return minutes > 0 ? `+${minutes}` : minutes
}

monitorClipboard(string => console.log(calcMinutes(string)))
