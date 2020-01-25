
import Command from "./Command";

export default class Render extends Command {
    constructor() {
        super('render', (message, connection) => {
            document.body.innerHTML = message.data.html ?? '<span># command error</span>';
        });
    }
}
