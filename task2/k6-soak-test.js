import http from "k6/http";
import { sleep, check } from "k6";

const searchEndpointUrl = 'http://localhost:8000/api/search?name=Mark';

export const options = {
    stages: [
        { duration: '2m', target: 400 }, // ramp up to 400 users
        { duration: '3h56m', target: 400 }, // stay at 400 for ~4 hours
        { duration: '2m', target: 0 }, // scale down. (optional)
    ],
};
export default function () {
    const BASE_URL = "http://localhost:8000/api/"; // make sure this is not production
    http.batch([
        ["GET", `${BASE_URL}search?name=Mark`],
        ["GET", `${BASE_URL}search?name=Jaron`],
        ["GET", `${BASE_URL}search?name=Marcelino`],
        ["GET", `${BASE_URL}search?name=Estel`],
    ]);
    sleep(1);
}
