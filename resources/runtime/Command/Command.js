import Connection from "../Connection";

export default class Command {
    /**
     * @type {string}
     * @private
     */
    _name;

    /**
     * @type {Function}
     * @private
     */
    _handler;

    /**
     * @param {string} name
     * @param {Function} handler
     */
    constructor(name, handler) {
        this._name = name;
        this._handler = handler || (() => {});
    }

    /**
     * @return {string}
     */
    getName() {
        return this._name;
    }

    /**
     * @param {Object} data
     * @param {Connection} connection
     * @return {null}
     */
    handle(data, connection) {
        this._handler(data, connection);
    }
}
