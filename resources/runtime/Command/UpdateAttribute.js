
import Command from "./Command";

export default class UpdateAttribute extends Command {
    constructor() {
        super('update', (message, connection) => {
            const element = document.getElementById(message.data.id);

            if (element) {
                switch (true) {
                    case message.data.value === true:
                        element.setAttribute(message.data.attr, message.data.attr);
                        break;

                    case typeof message.data.value === 'object':
                        let result = [];

                        for (let key of Object.keys(message.data.value)) {
                            result.push(`${key}: ${message.data.value[key]}`);
                        }

                        element.setAttribute(message.data.attr, result.join('; '));
                        break;

                    case message.data.value === null:
                        break;

                    default:
                        element.setAttribute(message.data.attr, message.data.value);
                }

            }
        });
    }
}
