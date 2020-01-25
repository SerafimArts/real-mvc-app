/**
 * WebSocket client
 */
export default class Client {
    /**
     * @type {WebSocket}
     * @private
     */
    _connection = null;

    /**
     * @type {string}
     * @private
     */
    _host;

    /**
     * @type {int}
     * @private
     */
    _reconnect;

    /**
     * @type {Object.<string, Command>}
     * @private
     */
    _commands = {};

    /**
     * @type {boolean}
     * @private
     */
    _closed = false;

    /**
     * @type {*[]}
     * @private
     */
    _handlers = [];

    /**
     * @param {string} host
     * @param {int} reconnect
     */
    constructor(host, reconnect = 100) {
        this._host = host;
        this._reconnect = reconnect;
    }

    /**
     * @param {Command} command
     * @return {this}
     */
    listen(command) {
        this._commands[command.getName()] = command;

        return this;
    }

    /**
     * @param {{}} message
     * @param {{}} payload
     */
    answer(message, payload= {}) {
        this.send({
            id: message.id,
            name: message.name,
            data: payload
        })
    }

    /**
     * @return {this}
     */
    connect() {
        this._connection = new WebSocket(this._host);

        this._connection.onopen = (event) => {
            console.log('connected');
        };

        this._connection.onerror = (error) => {
            console.error(error.message);
        };

        this._connection.onmessage = (event) => {
            const obj = JSON.parse(event.data) || {};

            if (this._commands[obj.name]) {
                this._commands[obj.name].handle(obj, this);
            } else {
                console.error(`Unrecognized command ${obj.name}`);
            }
        };

        this._connection.onclose = () => {
            console.log('disconnected');

            if (this._closed === false) {
                this.reconnect();
            }
        };

        return this;
    }

    /**
     * @return {this}
     */
    reconnect() {
        if (this._connection && this._reconnect) {
            this._connection = null;

            setTimeout(() => this.connect(), this._reconnect);
        }

        return this;
    }

    /**
     * @param {{}} message
     * @return {this}
     */
    send(message) {
        if (this._connection) {
            this._connection.send(JSON.stringify(message, this._serializer));
        }

        return this;
    }

    /**
     * @param k
     * @param v
     * @return {string|*}
     * @private
     */
    _serializer(k, v) {
        if (v instanceof Node) {
            return 'Node';
        }

        if (v instanceof Window) {
            return 'Window';
        }

        return v;
    };
}
