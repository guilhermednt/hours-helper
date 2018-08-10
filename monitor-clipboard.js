const clipy = require('clipboardy')

let lastClip = null

const monitorClipboard = (callback, interval) => {
    setInterval(() => {
        checkClipboard(clipy.readSync(), callback)
    }, interval || 500)
}

const checkClipboard = (current, callback) => {
    if (current !== lastClip) {
        lastClip = current
        callback(current)
    }
}

module.exports = monitorClipboard
