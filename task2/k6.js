import http from "k6/http";
import { sleep, check } from "k6";

export let options = {
    vus: 10, // virtual users
    duration: '30s',
    rps: 100 // requests per second
};

export default function () {
    let res = http.get("http://localhost:8000/api/search?name=Briana");
    check(res, {
        'response code was 200': (res) => res.status === 200,
    });

    sleep(1);
}
