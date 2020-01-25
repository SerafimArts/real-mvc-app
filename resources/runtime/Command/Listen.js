import Command from "./Command";

export default class Listen extends Command {
    constructor() {
        super('listen', (message, connection) => {
            const element = document.getElementById(message.data.id);

            if (element) {
                element.addEventListener(message.data.event, (event) => {
                    connection.answer(message, {
                        id: message.data.id,
                        event: message.data.event,
                        payload: this.event(event)
                    });

                    return false;
                }, true);
            }
        });
    }

    /**
     * @param {MouseEvent} event
     * @return {Object}
     */
    event(event) {
        return {
            altKey: event.altKey,
            bubbles: event.bubbles,
            button: event.button,
            buttons: event.buttons,
            cancelBubble: event.cancelBubble,
            cancelable: event.cancelable,
            clientX: event.clientX,
            clientY: event.clientY,
            composed: event.composed,
            ctrlKey: event.ctrlKey,
            currentTarget: event.currentTarget,
            defaultPrevented: event.defaultPrevented,
            detail: event.detail,
            eventPhase: event.eventPhase,
            isTrusted: event.isTrusted,
            metaKey: event.metaKey,
            movementX: event.movementX,
            movementY: event.movementY,
            offsetX: event.offsetX,
            offsetY: event.offsetY,
            pageX: event.pageX,
            pageY: event.pageY,
            relatedTarget: event.relatedTarget,
            returnValue: event.returnValue,
            screenX: event.screenX,
            screenY: event.screenY,
            shiftKey: event.shiftKey,
            timeStamp: event.timeStamp,
            type: event.type,
            x: event.x,
            y: event.y,
        }
    }
}
