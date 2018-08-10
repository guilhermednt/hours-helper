const clipy = require('clipboardy')

let lastClip = null

const monitorClipboard = (callback, interval) => {
    setInterval(() => {
        const current = clipy.readSync()
        if (current !== lastClip) {
            lastClip = current
            callback(current)
        }
    }, interval || 500)
}

module.exports = monitorClipboard
