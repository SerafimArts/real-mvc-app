
import Connection from "./Connection";

import Render from "./Command/Render";
import Listen from "./Command/Listen";
import UpdateAttribute from "./Command/UpdateAttribute";


const app = new Connection(`${process.env.SOCKET_PROTOCOL}://${window.location.hostname}:${process.env.SOCKET_PORT}`);

app.listen(new Render());
app.listen(new Listen());
app.listen(new UpdateAttribute());

app.connect();
